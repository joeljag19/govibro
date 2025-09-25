<?php
namespace App\Modules\AdminTours\Models;

use App\Models\BookingsModel;

class BookingsAdminModel extends BookingsModel
{
    /**
     * Obtener todas las reservas eliminadas
     * @return array
     */
    public function getDeleted()
    {
        return $this->getAll(null, true);
    }

    /**
     * Sobreescribir softDelete para registrar en audit_logs
     * @param int $id ID de la reserva
     * @param int $userId ID del usuario que realiza la acción
     * @return bool
     */
    public function softDelete($id, $userId = null)
    {
        $this->db->transBegin();

        $result = parent::softDelete($id);

        if ($result) {
            $this->db->table('audit_logs')->insert([
                'user_id' => $userId,
                'action' => 'Eliminó reserva (soft delete)',
                'entity_type' => 'booking',
                'entity_id' => $id,
                'details' => json_encode(['booking_id' => $id]),
                'created_at' => date('Y-m-d H:i:s'),
            ]);
        }

        $this->db->transCommit();
        return $result;
    }

    /**
     * Sobreescribir restore para registrar en audit_logs
     * @param int $id ID de la reserva
     * @param int $userId ID del usuario que realiza la acción
     * @return bool
     */
    public function restore($id, $userId = null)
    {
        $this->db->transBegin();

        $result = parent::restore($id);

        if ($result) {
            $this->db->table('audit_logs')->insert([
                'user_id' => $userId,
                'action' => 'Restauró reserva',
                'entity_type' => 'booking',
                'entity_id' => $id,
                'details' => json_encode(['booking_id' => $id]),
                'created_at' => date('Y-m-d H:i:s'),
            ]);
        }

        $this->db->transCommit();
        return $result;
    }

    // Dentro de la clase BookingsAdminModel

    /**
     * Obtiene todas las reservas de los tours que pertenecen a un owner específico.
     * Incluye el nombre del tour y los datos del cliente.
     *
     * @param int $ownerId
     * @return array
     */
    public function getBookingsByOwnerId($ownerId)
    {
        return $this->select('bookings.*, tours.title as tour_title, users.name as customer_name, users.email as customer_email')
                    ->join('tours', 'tours.id = bookings.object_id AND bookings.object_model = "tour"')
                    ->join('users', 'users.id = bookings.customer_id', 'left')
                    ->where('tours.owner_id', $ownerId)
                    ->orderBy('bookings.created_at', 'DESC')
                    ->paginate(15);
    }


    /**
     * Obtiene todas las reservas del sistema con detalles del tour, cliente y owner.
     * Para el panel del super_admin.
     * @return array
     */
    public function getAllBookingsWithDetails()
    {
        return $this->select('bookings.*, tours.title as tour_title, customer.name as customer_name, owner.name as owner_name')
                    ->join('tours', 'tours.id = bookings.object_id AND bookings.object_model = "tour"')
                    ->join('users as customer', 'customer.id = bookings.customer_id', 'left')
                    ->join('users as owner', 'owner.id = tours.owner_id', 'left')
                    ->orderBy('bookings.created_at', 'DESC')
                    ->paginate(20);
    }

    /**
     * Obtiene los detalles completos de una única reserva.
     * @param int $bookingId
     * @return array|null
     */
    public function getBookingDetails($bookingId)
    {
        return $this->select('bookings.*, tours.title as tour_title, customer.name as customer_name, owner.name as owner_name')
                    ->join('tours', 'tours.id = bookings.object_id AND bookings.object_model = "tour"')
                    ->join('users as customer', 'customer.id = bookings.customer_id', 'left')
                    ->join('users as owner', 'owner.id = tours.owner_id', 'left')
                    ->where('bookings.id', $bookingId)
                    ->first();
    }









}