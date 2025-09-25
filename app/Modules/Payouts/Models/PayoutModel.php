<?php
namespace App\Modules\Payouts\Models;

use CodeIgniter\Model;

class PayoutModel extends Model
{
    protected $table         = 'payouts';
    protected $primaryKey    = 'id';
    protected $allowedFields = [
        'payee_user_id', // Columna renombrada
        'payee_role',    // Nueva columna
        'payout_date',
        'amount',
        'status',
        'payment_method',
        'transaction_id',
        'admin_notes'
    ];

    protected $useTimestamps = false; 

    /**
     * Obtiene un historial de pagos con detalles del beneficiario (payee).
     * @return array
     */
    public function getPayoutsWithDetails()
    {
        return $this->select('payouts.*, users.name as payee_name')
                    ->join('users', 'users.id = payouts.payee_user_id') // Join con la tabla users
                    ->orderBy('payouts.payout_date', 'DESC')
                    ->paginate(20);
    }

        /**
     * Obtiene el historial de pagos para un beneficiario específico (payee).
     *
     * @param int $payeeUserId El user_id del revendedor o vendedor.
     * @return array
     */
    public function getHistoryByPayee($payeeUserId)
    {
        return $this->where('payee_user_id', $payeeUserId)
                    ->orderBy('payout_date', 'DESC')
                    ->paginate(20);
    }

}
