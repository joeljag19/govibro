<?php
namespace App\Modules\Commissions\Models;

use CodeIgniter\Model;

class CustomerResellerInteractionModel extends Model
{
    protected $table = 'customer_reseller_interactions';
    protected $primaryKey = 'id';
    protected $allowedFields = [
        'customer_id',
        'reseller_id',
        'seller_id',
        'unique_code',
        'interaction_date',
        'created_at',
        'updated_at'
    ];
    protected $useTimestamps = false;

    /**
     * Obtiene la interacción más reciente de un cliente antes de una fecha específica.
     *
     * @param int $customerId
     * @param string $saleDate
     * @param int $maxPeriodDays
     * @return array|null
     */
      public function getLatestInteractionForCustomer($customerId)
    {
        return $this->where('customer_id', $customerId)
                    ->orderBy('interaction_date', 'DESC')
                    ->first();
    }
    
}