<?php
namespace App\Models;

use CodeIgniter\Model;

class BookingsModel extends Model
{
    protected $table = 'bookings';
    protected $primaryKey = 'id';
    protected $allowedFields = [
        'code', 'vendor_id', 'customer_id', 'payment_id', 'gateway', 'object_id', 'object_model',
        'start_date', 'end_date', 'total', 'total_guests', 'currency', 'status', 'deposit',
        'deposit_type', 'commission', 'commission_type', 'email', 'first_name', 'last_name',
        'phone', 'address', 'address2', 'city', 'state', 'zip_code', 'country', 'customer_notes',
        'vendor_service_fee_amount', 'vendor_service_fee', 'create_user', 'update_user', 'deleted_at',
        'buyer_fees', 'total_before_fees', 'paid_vendor', 'object_child_id', 'number', 'paid',
        'pay_now', 'total_before_discount', 'coupon_amount'
    ];
    protected $useTimestamps = true;
    protected $createdField = 'created_at';
    protected $updatedField = 'updated_at';

    public function __construct()
    {
        parent::__construct();
        $this->db = \Config\Database::connect();
    }

    /**
     * Obtener todas las reservas (con opción de filtrar por eliminación suave)
     * @param int $tourId ID del tour (opcional)
     * @param bool $includeDeleted Incluir reservas eliminadas
     * @return array
     */
    public function getAll($tourId = null, $includeDeleted = false)
    {
        $builder = $this->select('bookings.*, tours.title as tour_title, users.name as customer_name')
                        ->join('tours', 'tours.id = bookings.object_id AND bookings.object_model = "tour"', 'left')
                        ->join('users', 'users.id = bookings.customer_id', 'left');

        if (!$includeDeleted) {
            $builder->where('bookings.deleted_at', null);
        }

        if ($tourId) {
            $builder->where('bookings.object_id', $tourId)
                    ->where('bookings.object_model', 'tour');
        }

        return $builder->findAll();
    }

    /**
     * Realizar una eliminación suave de una reserva
     * @param int $id ID de la reserva
     * @return bool
     */
    public function softDelete($id)
    {
        return $this->update($id, ['deleted_at' => date('Y-m-d H:i:s')]);
    }

    /**
     * Restaurar una reserva eliminada suavemente
     * @param int $id ID de la reserva
     * @return bool
     */
    public function restore($id)
    {
        return $this->update($id, ['deleted_at' => null]);
    }
}