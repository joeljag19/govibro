<?php
namespace App\Modules\Commissions\Models;

use CodeIgniter\Model;

class CommissionSettingsModel extends Model
{
    protected $table = 'commission_settings';
    protected $primaryKey = 'id';
    protected $allowedFields = ['type', 'fixed_amount', 'total_commission_percentage', 'period1_days', 'period1_reseller_share', 'period2_days', 'period2_reseller_share', 'period3_days', 'period3_reseller_share', 'max_period_days', 'created_at', 'updated_at'];

    /**
     * Obtiene la configuración activa.
     *
     * @return array|null
     */
    public function getActiveSettings()
    {
        return $this->first();
    }
}