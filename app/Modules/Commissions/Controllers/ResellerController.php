<?php
namespace App\Modules\Commissions\Controllers;

use CodeIgniter\Controller;
use App\Modules\Commissions\Models\ResellerModel;
use App\Modules\Commissions\Models\SellerModel;
use App\Modules\Commissions\Models\SellerInvitationModel;
use App\Modules\Commissions\Models\AuditLogModel;
use App\Modules\Commissions\Models\SaleModel;
use App\Modules\Commissions\Models\LinkClickModel;
use App\Modules\Commissions\Models\TrackingLinkModel;
use App\Modules\Payouts\Models\PayoutModel; 


class ResellerController extends Controller
{
    protected $resellerModel;
    protected $sellerModel;
    protected $invitationModel;
    protected $auditLogModel;

    public function __construct()
    {
        $this->resellerModel = new ResellerModel();
        $this->sellerModel = new SellerModel();
        $this->invitationModel = new SellerInvitationModel();
        $this->auditLogModel = new AuditLogModel();
    }
    /**
     * Muestra el panel de ganancias del revendedor.
     */
    public function dashboard()
    {
        $user = session('user');
        if (!$user || $user['role'] !== 'reseller') {
            return redirect()->to('/auth/login')->with('error', 'Acceso denegado.');
        }

        $reseller = $this->resellerModel->getByUserId($user['id']);
        if (!$reseller) {
            return redirect()->to('/')->with('error', 'Perfil de revendedor no encontrado.');
        }

        $saleModel = new SaleModel();
        $data['earnings'] = $saleModel->getEarningsByResellerId($reseller['id']);
        $data['sellers_earnings'] = $saleModel->getEarningsBySellersOfReseller($reseller['id']);

        return view('App\Modules\Commissions\Views\reseller\dashboard', $data);
    }

    /**
     * Muestra el formulario para invitar vendedores y la lista de invitaciones.
     */
    public function showInvitations()
    {
        $user = session('user');
        if (!$user || $user['role'] !== 'reseller') {
            return redirect()->to('/auth/login')->with('error', 'Acceso denegado.');
        }

        $reseller = $this->resellerModel->getByUserId($user['id']);
        if (!$reseller) {
            return redirect()->to('/')->with('error', 'Perfil de revendedor no encontrado.');
        }

        $data['invitations'] = $this->invitationModel->where('reseller_id', $reseller['id'])->orderBy('created_at', 'DESC')->findAll();
        
        return view('App\Modules\Commissions\Views\reseller\invitations', $data);
    }

    /**
     * Procesa el formulario para enviar una invitación a un nuevo vendedor.
     */
    public function sendInvitation()
    {
        $user = session('user');
        if (!$user || $user['role'] !== 'reseller') {
            return redirect()->to('/auth/login')->with('error', 'Acceso denegado.');
        }

        $reseller = $this->resellerModel->getByUserId($user['id']);
        if (!$reseller || !$this->resellerModel->canCreateSeller($reseller['id'])) {
            return redirect()->back()->with('error', 'Límite de vendedores alcanzado.');
        }

        $inviteeEmail = $this->request->getPost('invitee_email');
        $commissionPercentage = $this->request->getPost('commission_percentage');

        if (empty($inviteeEmail) || empty($commissionPercentage)) {
            return redirect()->back()->with('error', 'El email y el porcentaje de comisión son obligatorios.');
        }
        
        // (Opcional: verificar si el email ya existe en la tabla de usuarios)

        $invitationCode = bin2hex(random_bytes(16));

        $data = [
            'reseller_id'           => $reseller['id'],
            'invitee_email'         => $inviteeEmail,
            'invitation_code'       => $invitationCode,
            'commission_percentage' => $commissionPercentage,
            'status'                => 'pending'
        ];

        $this->invitationModel->insert($data);
        $this->auditLogModel->log($user['id'], 'Envió invitación a vendedor', 'seller_invitation', $this->invitationModel->insertID(), $data);

        return redirect()->back()->with('success', 'Invitación enviada exitosamente.');
    }


    /**
     * Muestra el dashboard de enlaces (propios y de vendedores) y el historial de clics.
     */
    public function links()
    {
        $user = session('user');
        if (!$user || $user['role'] !== 'reseller') {
            return redirect()->to('/auth/login')->with('error', 'Acceso denegado.');
        }

        $reseller = $this->resellerModel->getByUserId($user['id']);
        if (!$reseller) {
            return redirect()->to('/')->with('error', 'Perfil de revendedor no encontrado.');
        }

        $trackingLinkModel = new TrackingLinkModel();
        $clickModel = new LinkClickModel();

        // Cargar los diferentes tipos de datos
        $data['reseller_links'] = $trackingLinkModel->getResellerLinksWithDetails($reseller['id']);
        $data['seller_links'] = $trackingLinkModel->getSellerLinksByReseller($reseller['id']);
        $data['clicks'] = $clickModel->where('reseller_id', $reseller['id'])->orderBy('created_at', 'DESC')->paginate(15);
        $data['pager'] = $clickModel->pager;

        return view('App\Modules\Commissions\Views\reseller\links', $data);
    }

    /**
     * Procesa la creación de un nuevo enlace de campaña.
     */
    public function createLink()
    {
        $user = session('user');
        if (!$user || $user['role'] !== 'reseller') {
            return redirect()->to('/auth/login')->with('error', 'Acceso denegado.');
        }
        
        $reseller = $this->resellerModel->getByUserId($user['id']);
        $linkName = $this->request->getPost('link_name');

        if (empty($linkName)) {
            return redirect()->back()->with('error', 'El nombre de la campaña es obligatorio.');
        }
        
        $trackingLinkModel = new TrackingLinkModel();
        $trackingLinkModel->createCampaignLink($reseller['id'], $linkName);

        return redirect()->to('/commissions/reseller/links')->with('success', 'Enlace de campaña creado exitosamente.');
    }

    /**
     * Muestra la lista de vendedores del revendedor.
     */
    public function showSellers()
    {
        $user = session('user');
        if (!$user || $user['role'] !== 'reseller') {
            return redirect()->to('/auth/login')->with('error', 'Acceso denegado.');
        }

        $reseller = $this->resellerModel->getByUserId($user['id']);
        if (!$reseller) {
            return redirect()->to('/')->with('error', 'Perfil de revendedor no encontrado.');
        }

        $data['sellers'] = $this->sellerModel->getSellersByResellerId($reseller['id']);

        return view('App\Modules\Commissions\Views\reseller\sellers', $data);
    }

    // ...

    /**
     * Muestra el historial de pagos del revendedor.
     */
    public function paymentHistory()
    {
        $user = session('user');
        if (!$user || $user['role'] !== 'reseller') {
            return redirect()->to('/auth/login')->with('error', 'Acceso denegado.');
        }

        $payoutModel = new PayoutModel();
        $data['payouts'] = $payoutModel->getHistoryByPayee($user['id']);
        $data['pager'] = $payoutModel->pager;

        return view('App\Modules\Commissions\Views\reseller\payment_history', $data);
    }

     /**
     * Muestra el reporte de ventas detallado para el revendedor.
     */
    public function salesReport()
    {
        $user = session('user');
        $reseller = $this->resellerModel->where('user_id', $user['id'])->first();

        if (!$reseller) {
            return redirect()->to('/commissions/reseller/dashboard')->with('error', 'Perfil de revendedor no encontrado.');
        }

        $saleModel = new \App\Modules\Commissions\Models\SaleModel();
        $data['sales'] = $saleModel->getDetailedSalesForReseller($reseller['id']);
        $data['pager'] = $saleModel->pager;

        return view('App\Modules\Commissions\Views\reseller\sales_report', $data);
    }








}