<?php
namespace App\Modules\Commissions\Controllers;

use CodeIgniter\Controller;
use App\Modules\Commissions\Models\SaleModel;
use App\Modules\Commissions\Models\ResellerModel;
use App\Modules\Commissions\Models\SellerModel;
use App\Modules\Commissions\Models\TrackingLinkModel;
use App\Modules\Commissions\Models\CustomerResellerInteractionModel;
use App\Modules\AdminTours\Models\TourAdminModel;
use App\Modules\OwnerPanel\Models\OwnerModel;
use App\Modules\Commissions\Models\AuditLogModel;

class SaleController extends Controller
{
    protected $saleModel;
    protected $resellerModel;
    protected $sellerModel;
    protected $trackingLinkModel;
    protected $interactionModel;
    protected $auditLogModel;

    public function __construct()
    {
        $this->saleModel = new SaleModel();
        $this->resellerModel = new ResellerModel();
        $this->sellerModel = new SellerModel();
        $this->trackingLinkModel = new TrackingLinkModel();
        $this->interactionModel = new CustomerResellerInteractionModel();
        $this->auditLogModel = new AuditLogModel();
        $this->request = \Config\Services::request();
        $this->response = \Config\Services::response();
    }

    public function processSale()
    {
        $tourId = $this->request->getPost('tour_id');
        $saleAmount = (float) $this->request->getPost('sale_amount');
        $customerId = session('user')['id'] ?? null;

        if (!$tourId || !$saleAmount) {
            return $this->response->setJSON(['success' => false, 'message' => 'Datos de venta incompletos.']);
        }

        $tourModel = new TourAdminModel();
        $tour = $tourModel->find($tourId);
        if (!$tour) { return $this->response->setJSON(['success' => false, 'message' => 'Tour no encontrado.']); }

        $ownerModel = new OwnerModel();
        $owner = $ownerModel->where('user_id', $tour['owner_id'])->first();
        if (!$owner) { return $this->response->setJSON(['success' => false, 'message' => 'Perfil del dueño no encontrado.']); }

        $platformCommissionPercentage = (float) $owner['platform_commission_percentage'];
        $totalCommissionPot = ($platformCommissionPercentage / 100) * $saleAmount;
        $ownerEarning = $saleAmount - $totalCommissionPot;

        // --- LÓGICA DE SEGUIMIENTO DE DOS NIVELES (RESTAURADA) ---
        $resellerId = null;
        $sellerId = null;
        $interactionId = null;
        $interactionDate = date('Y-m-d H:i:s');

        // Nivel 1: Usuario que ha iniciado sesión
        if ($customerId) {
            $interaction = $this->interactionModel->getLatestInteractionForCustomer($customerId);
            if ($interaction) {
                $interactionId = $interaction['id'];
                $interactionDate = $interaction['interaction_date'];
                $resellerId = $interaction['reseller_id'];
                $sellerId = $interaction['seller_id'];
            }
        }
        
        // Nivel 2: Usuario invitado (fallback a la cookie)
        if (!$resellerId) {
            $refCode = $this->request->getCookie('ref_code');
            if ($refCode) {
                $link = $this->trackingLinkModel->getByCode($refCode);
                if ($link) {
                    $resellerId = $link['reseller_id'];
                    $sellerId = $link['seller_id'];
                    $interactionDate = $this->request->getCookie('ref_date') ?? date('Y-m-d H:i:s');
                }
            }
        }
        // --- FIN DE LA LÓGICA DE SEGUIMIENTO ---

        $resellerShare = 0;
        $sellerCommission = 0;
        $resellerNetCommission = 0;
        $platformNetCommission = $totalCommissionPot;
        $commissionProfileRange = null;
        $sellerCommissionSharePercentage = null;

        if ($resellerId) {
            $profile = $this->resellerModel->getCommissionProfile($resellerId);
            if ($profile && !empty($profile['ranges'])) {
                $days = (new \DateTime())->diff(new \DateTime($interactionDate))->days + 1;
                
                foreach ($profile['ranges'] as $range) {
                    $endDay = $range['end_day'] ?? PHP_INT_MAX;
                    if ($days >= $range['start_day'] && $days <= $endDay) {
                        $resellerCommissionPercentage = (float)$range['reseller_share'];
                        $commissionProfileRange = "Día {$range['start_day']} - {$endDay}: {$resellerCommissionPercentage}%";
                        break;
                    }
                }

                if (isset($resellerCommissionPercentage) && $resellerCommissionPercentage > 0) {
                    $resellerShare = ($resellerCommissionPercentage / 100) * $saleAmount;
                    if ($resellerShare > $totalCommissionPot) { $resellerShare = $totalCommissionPot; }

                    $resellerNetCommission = $resellerShare;
                    
                    if ($sellerId) {
                        $seller = $this->sellerModel->find($sellerId);
                        if ($seller) {
                            $sellerCommissionSharePercentage = (float) $seller['commission_share_percentage'];
                            $sellerCommission = ($sellerCommissionSharePercentage / 100) * $resellerShare;
                            $resellerNetCommission = $resellerShare - $sellerCommission;
                        }
                    }
                    $platformNetCommission = $totalCommissionPot - $resellerShare;
                }
            }
        }

        $saleData = [
            'tour_id'                 => $tourId,
            'customer_id'             => $customerId,
            'reseller_id'             => $resellerId,
            'seller_id'               => $sellerId,
            'sale_amount'             => $saleAmount,
            'interaction_id'          => $interactionId,
            'total_commission'        => $totalCommissionPot,
            'reseller_share'          => $resellerShare,
            'seller_commission'       => $sellerCommission,
            'reseller_net_commission' => $resellerNetCommission,
            'platform_commission'     => $platformNetCommission,
            'owner_earning'           => $ownerEarning,
            'commission_profile_range' => $commissionProfileRange,
            'seller_commission_share_percentage' => $sellerCommissionSharePercentage,
        ];
        
        $saleId = $this->saleModel->insert($saleData);
        $this->auditLogModel->log($customerId, 'Venta procesada', 'sale', $saleId, $saleData);

        return $this->response->setJSON(['success' => true, 'message' => 'Venta procesada.']);
    }
}
