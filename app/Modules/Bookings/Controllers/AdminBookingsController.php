<?php
namespace App\Modules\Bookings\Controllers;

use CodeIgniter\Controller;
use App\Modules\AdminTours\Models\BookingsAdminModel;

class AdminBookingsController extends Controller
{
    protected $bookingsModel;

    public function __construct()
    {
        $this->bookingsModel = new BookingsAdminModel();
    }

    /**
     * Muestra la lista de todas las reservas del sistema.
     */
    public function index()
    {
        // Usaremos un nuevo método en el modelo para obtener todos los detalles.
        $data['bookings'] = $this->bookingsModel->getAllBookingsWithDetails();
        $data['pager'] = $this->bookingsModel->pager;

        return view('App\Modules\Bookings\Views\admin\index', $data);
    }

    /**
     * Muestra los detalles completos de una reserva específica.
     */
    public function view($id)
    {
        $data['booking'] = $this->bookingsModel->getBookingDetails($id);

        if (!$data['booking']) {
            return redirect()->to('/admin/bookings')->with('error', 'Reserva no encontrada.');
        }

        return view('App\Modules\Bookings\Views\admin\view', $data);
    }
}
