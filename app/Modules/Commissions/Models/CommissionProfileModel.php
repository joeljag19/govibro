<?php
namespace App\Modules\Commissions\Models;

use CodeIgniter\Model;

class CommissionProfileModel extends Model
{
    protected $table = 'commission_profiles';
    protected $primaryKey = 'id';
    protected $allowedFields = [
        'name',
        'type', // 'fixed', 'percentage', 'combined'
        'fixed_amount',
        'description',
        'default_reseller_share' // Este campo podría ser útil para un valor base
    ];
    protected $useTimestamps = true;

    /**
     * Obtiene los rangos de comisión asociados a un perfil.
     *
     * @param int $profileId
     * @return array
     */
    public function getRanges($profileId)
    {
        return $this->db->table('commission_ranges')
                        ->where('profile_id', $profileId)
                        ->orderBy('sequence', 'ASC')
                        ->get()
                        ->getResultArray();
    }

        /**
     * Obtiene todos los perfiles de comisiones y adjunta sus rangos correspondientes.
     *
     * @return array
     */
    public function getProfilesWithRanges()
    {
        $profiles = $this->findAll();
        if (empty($profiles)) {
            return [];
        }

        $rangeModel = new CommissionRangeModel();

        foreach ($profiles as &$profile) {
            $profile['ranges'] = $rangeModel->where('profile_id', $profile['id'])
                                            ->orderBy('sequence', 'ASC')
                                            ->findAll();
        }

        return $profiles;
    }
}