<?php
namespace App\Modules\OwnerPanel\Controllers;

use CodeIgniter\Controller;
use App\Modules\AdminTours\Models\BookingsAdminModel;
use App\Modules\AdminTours\Models\TourAdminModel;

class OwnerBookingsController extends Controller
{
    /**
     * Envía un mensaje de un owner a un cliente a través del sistema de correo.
     */
    public function sendMessage()
    {
        $user = session('user');
        $bookingId = $this->request->getPost('booking_id');
        $messageContent = $this->request->getPost('message');

        if (!$user || $user['role'] !== 'owner') {
            return redirect()->back()->with('error', 'Acción no permitida.');
        }

        if (empty($bookingId) || empty($messageContent)) {
            return redirect()->back()->with('error', 'Faltan datos para enviar el mensaje.');
        }

        $bookingsModel = new BookingsAdminModel();
        $booking = $bookingsModel->find($bookingId);

        // Verificación de seguridad: Asegurarse de que el owner solo pueda contactar a clientes de sus propios tours.
        $tourModel = new TourAdminModel();
        $tour = $tourModel->find($booking['object_id']);

        if (!$booking || !$tour || $tour['owner_id'] != $user['id']) {
            return redirect()->back()->with('error', 'Reserva no válida o no tienes permiso para contactar a este cliente.');
        }

        // Configurar y enviar el correo
        $email = \Config\Services::email();
        
        $email->setTo($booking['email']);
        $email->setSubject("Un mensaje sobre tu reserva #" . $booking['id'] . " para el tour: " . $tour['title']);
        
        // Usar una plantilla de correo para un diseño profesional
        $emailBody = view('App\Modules\OwnerPanel\Views\emails\message_template', [
            'owner_name' => $user['name'],
            'tour_title' => $tour['title'],
            'message_content' => $messageContent,
            'customer_name' => $booking['first_name']
        ]);
        $email->setMessage($emailBody);

        if ($email->send(false)) { // 'false' para no limpiar los datos y poder depurar
            return redirect()->to('/owner/bookings')->with('success', 'Mensaje enviado al cliente exitosamente.');
        } else {
            log_message('error', 'Fallo al enviar correo: ' . $email->printDebugger(['headers']));
            return redirect()->back()->with('error', 'No se pudo enviar el mensaje. Por favor, revisa la configuración de correo y contacta al administrador.');
        }
    }
}
