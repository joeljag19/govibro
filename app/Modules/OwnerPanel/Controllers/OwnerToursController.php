<?php
namespace App\Modules\OwnerPanel\Controllers;

use CodeIgniter\Controller;
use App\Modules\AdminTours\Models\TourAdminModel;
use App\Modules\AdminTours\Models\TourAvailabilityModel; // Crearemos este modelo

class OwnerToursController extends Controller
{
    protected $tourModel;

    public function __construct()
    {
        $this->tourModel = new TourAdminModel();
    }

    /**
     * Muestra la vista del calendario de disponibilidad para un tour específico.
     */
    public function showAvailability($tourId)
    {
        $user = session('user');
        $tour = $this->tourModel->find($tourId);

        // Verificar que el tour existe y pertenece al owner logueado
        if (!$tour || $tour['owner_id'] != $user['id']) {
            return redirect()->to('/owner/dashboard')->with('error', 'No tienes permisos para gestionar este tour.');
        }

        $data['tour'] = $tour;
        return view('App\Modules\OwnerPanel\Views\tours\availability', $data);
    }

    /**
     * Obtiene los eventos de disponibilidad para el calendario (vía AJAX).
     */
    public function getAvailabilityEvents($tourId)
    {
        $availabilityModel = new TourAvailabilityModel();
        $events = $availabilityModel->getEventsForCalendar($tourId);
        return $this->response->setJSON($events);
    }

    /**
     * Guarda (crea o actualiza) un evento de disponibilidad (vía AJAX).
     */
    public function saveAvailability()
    {
        $user = session('user');
        $data = $this->request->getJSON(true);

        $tour = $this->tourModel->find($data['tour_id']);
        if (!$tour || $tour['owner_id'] != $user['id']) {
            return $this->response->setStatusCode(403)->setJSON(['success' => false, 'message' => 'No autorizado']);
        }

        $availabilityModel = new TourAvailabilityModel();
        $result = $availabilityModel->saveEvent($data);

        if ($result) {
            return $this->response->setJSON(['success' => true, 'id' => $result]);
        } else {
            return $this->response->setStatusCode(500)->setJSON(['success' => false, 'message' => 'No se pudo guardar el evento.']);
        }
    }

    // Dentro de la clase OwnerToursController

    /**
     * Elimina un evento de disponibilidad (vía AJAX).
     */
    public function deleteAvailability()
    {
        $user = session('user');
        $id = $this->request->getJSON(true)['id'];

        if (!$id) {
            return $this->response->setStatusCode(400)->setJSON(['success' => false, 'message' => 'ID de evento no proporcionado.']);
        }

        $availabilityModel = new \App\Modules\AdminTours\Models\TourAvailabilityModel();
        $event = $availabilityModel->find($id);

        if (!$event) {
            return $this->response->setStatusCode(404)->setJSON(['success' => false, 'message' => 'Evento no encontrado.']);
        }

        // Verificación de seguridad: ¿El tour de este evento pertenece al usuario actual?
        $tour = $this->tourModel->find($event['tour_id']);
        if (!$tour || $tour['owner_id'] != $user['id']) {
            return $this->response->setStatusCode(403)->setJSON(['success' => false, 'message' => 'No autorizado para eliminar este evento.']);
        }

        // Proceder con la eliminación
        if ($availabilityModel->delete($id)) {
            return $this->response->setJSON(['success' => true]);
        } else {
            return $this->response->setStatusCode(500)->setJSON(['success' => false, 'message' => 'No se pudo eliminar el evento.']);
        }
    }


}
