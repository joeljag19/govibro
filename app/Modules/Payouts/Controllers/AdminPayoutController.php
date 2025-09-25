<?php
namespace App\Modules\Payouts\Controllers;

use CodeIgniter\Controller;
use App\Modules\Commissions\Models\ResellerModel;
use App\Modules\Commissions\Models\SellerModel;
use App\Modules\Commissions\Models\SaleModel;
use App\Modules\Payouts\Models\PayoutModel;
use App\Modules\Payouts\Models\PayoutItemModel;
use App\Modules\Commissions\Models\AuditLogModel;

class AdminPayoutController extends Controller
{
    protected $resellerModel;
    protected $sellerModel;
    protected $saleModel;
    protected $payoutModel;
    protected $payoutItemModel;
    protected $auditLogModel;
    protected $db;

    public function __construct()
    {
        $this->resellerModel = new ResellerModel();
        $this->sellerModel = new SellerModel();
        $this->saleModel = new SaleModel();
        $this->payoutModel = new PayoutModel();
        $this->payoutItemModel = new PayoutItemModel();
        $this->auditLogModel = new AuditLogModel();
        $this->db = \Config\Database::connect();
    }

    /**
     * Muestra la página principal para generar un nuevo pago.
     */
    public function index()
    {
        $data['resellers'] = $this->resellerModel->getResellersWithDetails();
        $data['sellers'] = $this->sellerModel->getSellersWithDetails();
        return view('App\Modules\Payouts\Views\admin\index', $data);
    }

    /**
     * Genera un reporte de comisiones pendientes para un revendedor o vendedor.
     */
    public function generateReport()
    {
        $payeeType = $this->request->getPost('payee_type');
        $payeeId = $this->request->getPost('payee_id');
        $startDate = $this->request->getPost('start_date');
        $endDate = $this->request->getPost('end_date');

        if (!$payeeType || !$payeeId) {
            return redirect()->back()->withInput()->with('error', 'Por favor, selecciona un tipo de afiliado y un afiliado.');
        }

        $payee = null;
        $unpaidCommissions = [];

        if ($payeeType === 'reseller') {
            $payee = $this->resellerModel->getResellersWithDetails($payeeId);
            $unpaidCommissions = $this->saleModel->getUnpaidCommissionsForReseller($payeeId, $startDate, $endDate);
        } elseif ($payeeType === 'seller') {
            $payee = $this->sellerModel->getSellersWithDetails($payeeId);
            $unpaidCommissions = $this->saleModel->getUnpaidCommissionsForSeller($payeeId, $startDate, $endDate);
        }

        if (!$payee) {
            return redirect()->back()->with('error', 'Afiliado no encontrado.');
        }
        
        $totalAmount = array_sum(array_column($unpaidCommissions, 'commission_amount'));

        $data = [
            'payee' => $payee,
            'payee_type' => $payeeType,
            'commissions' => $unpaidCommissions,
            'total_amount' => $totalAmount,
            'start_date' => $startDate,
            'end_date' => $endDate
        ];

        return view('App\Modules\Payouts\Views\admin\report', $data);
    }

    /**
     * Crea el lote de pago, marca las comisiones como pagadas y registra el pago.
     */
    public function createPayout()
    {
        $user = session('user');
        $payeeUserId = $this->request->getPost('payee_user_id');
        $payeeRole = $this->request->getPost('payee_role');
        $saleIds = $this->request->getPost('sale_ids');
        $amount = (float)$this->request->getPost('amount');

        if (!$payeeUserId || !$payeeRole || empty($saleIds) || !$amount) {
            return redirect()->to('/payouts/admin')->with('error', 'Datos insuficientes para crear el pago.');
        }

        $this->db->transBegin();
        try {
            // 1. Crear el registro principal del Payout
            $payoutData = [
                'payee_user_id' => $payeeUserId,
                'payee_role'    => $payeeRole,
                'payout_date'   => date('Y-m-d H:i:s'),
                'amount'        => $amount,
                'status'        => 'paid',
                'payment_method' => $this->request->getPost('payment_method'),
                'transaction_id' => $this->request->getPost('transaction_id'),
                'admin_notes'    => $this->request->getPost('admin_notes'),
            ];
            $payoutId = $this->payoutModel->insert($payoutData);

            // 2. Crear los Payout Items y actualizar las ventas
            $commissionsToPay = $this->saleModel->whereIn('id', $saleIds)->findAll();
            $updateColumn = ($payeeRole === 'reseller') ? 'reseller_payout_id' : 'seller_payout_id';

            foreach ($commissionsToPay as $commission) {
                $commissionAmount = ($payeeRole === 'reseller') ? $commission['reseller_net_commission'] : $commission['seller_commission'];
                $this->payoutItemModel->insert([
                    'payout_id' => $payoutId,
                    'sale_id' => $commission['id'],
                    'commission_amount' => $commissionAmount
                ]);
                $this->saleModel->update($commission['id'], [$updateColumn => $payoutId]);
            }

            if ($this->db->transStatus() === false) {
                throw new \Exception('Error en la transacción de la base de datos.');
            }

            $this->db->transCommit();
            $this->auditLogModel->log($user['id'], 'Creó lote de pago', 'payout', $payoutId, $payoutData);
            return redirect()->to('/payouts/admin/history')->with('success', 'Lote de pago creado y comisiones marcadas como pagadas.');

        } catch (\Exception $e) {
            $this->db->transRollback();
            log_message('error', '[AdminPayoutController::createPayout] ' . $e->getMessage());
            return redirect()->to('/payouts/admin')->with('error', 'Ocurrió un error inesperado.');
        }
    }

    /**
     * Muestra el historial de pagos realizados.
     */
    public function history()
    {
        $data['payouts'] = $this->payoutModel->getPayoutsWithDetails();
        $data['pager'] = $this->payoutModel->pager;
        return view('App\Modules\Payouts\Views\admin\history', $data);
    }
}
