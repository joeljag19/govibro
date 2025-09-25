<?php
namespace App\Controllers;

use CodeIgniter\Controller;
use App\Modules\OwnerPanel\Models\OwnerModel;
use App\Modules\AdminTours\Models\BookingsAdminModel;
use Spatie\IcalendarGenerator\Components\Calendar;
use Spatie\IcalendarGenerator\Components\Event;

class IcalController extends Controller
{
    public function getOwnerFeed($token)
    {
        if (empty($token)) {
            return $this->response->setStatusCode(400, 'Token no proporcionado.');
        }

        $ownerModel = new OwnerModel();
        $owner = $ownerModel->where('ical_token', $token)->first();

        if (!$owner) {
            return $this->response->setStatusCode(403, 'Token no válido o no encontrado.');
        }

        $bookingsModel = new BookingsAdminModel();
        $bookings = $bookingsModel->getBookingsByOwnerId($owner['user_id']);

        $calendar = Calendar::create('Reservas GoVibro');

        foreach ($bookings as $booking) {
            $event = Event::create()
                ->name("Reserva #" . $booking['id'] . ": " . $booking['tour_title'])
                ->description("Cliente: {$booking['customer_name']}\nPersonas: {$booking['total_guests']}")
                ->startsAt(new \DateTime($booking['start_date']))
                ->endsAt(new \DateTime($booking['end_date']));
            
            $calendar->event($event);
        }

        return $this->response
                    ->setStatusCode(200)
                    ->setHeader('Content-Type', 'text/calendar; charset=utf-8')
                    ->setHeader('Content-Disposition', 'attachment; filename="calendar.ics"')
                    ->setBody($calendar->get());
    }
}
