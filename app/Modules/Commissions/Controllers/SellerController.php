<?php
namespace App\Modules\Commissions\Controllers;

use CodeIgniter\Controller;
use App\Modules\Commissions\Models\SellerModel;
use App\Modules\Commissions\Models\SaleModel;
use App\Modules\Commissions\Models\TrackingLinkModel;
use App\Modules\Payouts\Models\PayoutModel; 

class SellerController extends Controller
{
    protected $sellerModel;

    public function __construct()
    {
        $this->sellerModel = new SellerModel();
    }

    /**
     * Muestra el panel principal con las ganancias del vendedor.
     */
    public function dashboard()
    {
        $user = session('user');
        if (!$user || $user['role'] !== 'seller') {
            return redirect()->to('/auth/login')->with('error', 'Acceso denegado.');
        }

        $seller = $this->sellerModel->where('user_id', $user['id'])->first();
        if (!$seller) {
            return redirect()->to('/')->with('error', 'Perfil de vendedor no encontrado.');
        }

        $saleModel = new SaleModel();
        $data['earnings'] = $saleModel->getEarningsBySellerId($seller['id']);

        return view('App\Modules\Commissions\Views\seller\dashboard', $data);
    }

    /**
     * Muestra los enlaces de seguimiento del vendedor.
     */
    public function links()
    {
        $user = session('user');
        if (!$user || $user['role'] !== 'seller') {
            return redirect()->to('/auth/login')->with('error', 'Acceso denegado.');
        }

        $seller = $this->sellerModel->where('user_id', $user['id'])->first();
        if (!$seller) {
            return redirect()->to('/')->with('error', 'Perfil de vendedor no encontrado.');
        }

        $trackingLinkModel = new TrackingLinkModel();
        $data['links'] = $trackingLinkModel->getLinksBySellerId($seller['id']);

        return view('App\Modules\Commissions\Views\seller\links', $data);
    }

    /**
     * Muestra el historial de pagos del vendedor.
     */
    public function paymentHistory()
    {
        $user = session('user');
        if (!$user || $user['role'] !== 'seller') {
            return redirect()->to('/auth/login')->with('error', 'Acceso denegado.');
        }

        $payoutModel = new PayoutModel();
        $data['payouts'] = $payoutModel->getHistoryByPayee($user['id']);
        $data['pager'] = $payoutModel->pager;

        return view('App\Modules\Commissions\Views\seller\payment_history', $data);
    }
}