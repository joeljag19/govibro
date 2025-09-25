<?php
namespace App\Modules\OwnerPanel\Controllers;

use CodeIgniter\Controller;
use App\Modules\Commissions\Models\SaleModel;
use App\Modules\AdminTours\Models\BookingsAdminModel; 
use App\Modules\OwnerPanel\Models\OwnerModel; 

class DashboardController extends Controller
{
 /**
     * Muestra el dashboard principal para el dueño del servicio (owner).
     */
    public function dashboard()
    {
        $user = session('user');
        if (!$user || !in_array($user['role'], ['owner', 'super_admin'])) {
            return redirect()->to('/auth/login')->with('error', 'Acceso denegado.');
        }
        
        $ownerId = $user['id'];

        $saleModel = new SaleModel();
        $ownerModel = new OwnerModel(); // Instanciamos el modelo del owner
        
        $data['summary'] = $saleModel->getEarningsByOwnerId($ownerId);
        $data['tour_performance'] = $saleModel->getTourPerformanceByOwner($ownerId);
        // Cargamos el perfil del owner para obtener el token de iCal
        $data['ownerProfile'] = $ownerModel->where('user_id', $ownerId)->first();

        return view('App\Modules\OwnerPanel\Views\dashboard', $data);
    }
    /**
     * Muestra la lista de reservas para el dueño del servicio (owner).
     */
    public function bookings()
    {
        $user = session('user');
        if (!$user || !in_array($user['role'], ['owner', 'super_admin'])) {
            return redirect()->to('/auth/login')->with('error', 'Acceso denegado.');
        }

        $ownerId = $user['id'];
        $bookingsModel = new BookingsAdminModel();

        $data['bookings'] = $bookingsModel->getBookingsByOwnerId($ownerId);
        $data['pager'] = $bookingsModel->pager;

        return view('App\Modules\OwnerPanel\Views\bookings', $data);
    }
}
