<?php
namespace App\Modules\Commissions\Models;

use CodeIgniter\Model;

class ResellerModel extends Model
{
    protected $table = 'resellers';
    protected $primaryKey = 'id';
    protected $allowedFields = ['user_id', 'contact_info', 'max_sellers', 'commission_profile_id', 'first_name', 'last_name', 'address', 'phone', 'identity_document', 'created_at', 'updated_at'];

    /**
     * Obtiene un reseller por user_id.
     *
     * @param int $userId
     * @return array|null
     */
    public function getByUserId($userId)
    {
        return $this->where('user_id', $userId)->first();
    }

    /**
     * Verifica si el reseller puede crear más vendedores.
     *
     * @param int $resellerId
     * @return bool
     */
    public function canCreateSeller($resellerId)
    {
        $reseller = $this->find($resellerId);
        if (!$reseller) return false;
        $sellerModel = new SellerModel();
        $count = $sellerModel->where('reseller_id', $resellerId)->countAllResults();
        return $count < $reseller['max_sellers'];
    }

    /**
     * Obtiene el perfil de comisiones del reseller o el global por default.
     *
     * @param int $resellerId
     * @return array
     */
    public function getCommissionProfile($resellerId)
    {
        $reseller = $this->find($resellerId);
        if (!$reseller || !$reseller['commission_profile_id']) {
            $settingsModel = new CommissionSettingsModel();
            $settings = $settingsModel->getActiveSettings();
            $settings['ranges'] = []; // Fallback sin rangos, o carga global si es necesario
            return $settings;
        }

        $profileModel = new CommissionProfileModel();
        $profile = $profileModel->find($reseller['commission_profile_id']);
        $profile['ranges'] = $profileModel->getRanges($profile['id']);
        $profile['default_reseller_share'] = $profile['default_reseller_share'] ?? 100.00; // Default 100% para Período 0
        return $profile;
    }

    /**
     * Obtiene revendedores con detalles adicionales.
     * Si se proporciona un ID, devuelve solo ese revendedor.
     * Si no, devuelve todos.
     *
     * @param int|null $resellerId
     * @return array
     */
    public function getResellersWithDetails($resellerId = null)
    {
        $builder = $this->select('resellers.*, users.name as user_name, commission_profiles.name as profile_name')
                        ->join('users', 'users.id = resellers.user_id', 'left')
                        ->join('commission_profiles', 'commission_profiles.id = resellers.commission_profile_id', 'left');

        if ($resellerId) {
            return $builder->where('resellers.id', $resellerId)->first();
        }

        return $builder->findAll();
    }







}