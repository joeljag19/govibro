<?php
namespace App\Modules\Admin\Controllers; // <-- NAMESPACE CAMBIADO

use CodeIgniter\Controller;
use App\Modules\Commissions\Models\SaleModel;

class DashboardController extends Controller
{
    public function index()
    {
        $user = session('user');
        if (!$user || $user['role'] !== 'super_admin') {
            return redirect()->to('/')->with('error', 'Acceso denegado.');
        }

        $saleModel = new SaleModel();
        $data['summary'] = $saleModel->getPlatformOverallSummary();

        // RUTA DE LA VISTA CAMBIADA
        return view('App\Modules\Admin\Views\dashboard', $data);
    }
}