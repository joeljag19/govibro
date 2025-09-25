<?php
namespace App\Modules\Commissions\Models;

use CodeIgniter\Model;

class SellerInvitationModel extends Model
{
    protected $table = 'seller_invitations';
    protected $primaryKey = 'id';
    protected $allowedFields = [
        'reseller_id',
        'invitee_email',
        'invitation_code',
        'status',
        'commission_percentage',
        'created_at',
        'updated_at'
    ];
    protected $useTimestamps = false;

    /**
     * Genera una nueva invitación para un vendedor.
     *
     * @param int $resellerId
     * @param string $inviteeEmail
     * @param float $commissionPercentage
     * @return string
     */
    public function createInvitation($resellerId, $inviteeEmail, $commissionPercentage)
    {
        $invitationCode = bin2hex(random_bytes(16)); // Genera un código único
        $data = [
            'reseller_id' => $resellerId,
            'invitee_email' => $inviteeEmail,
            'invitation_code' => $invitationCode,
            'commission_percentage' => $commissionPercentage
        ];
        $this->insert($data);
        return $invitationCode;
    }

    /**
     * Obtiene una invitación por su código.
     *
     * @param string $invitationCode
     * @return array|null
     */
    public function getByCode($invitationCode)
    {
        return $this->where('invitation_code', $invitationCode)->first();
    }

    /**
     * Obtiene todas las invitaciones de un revendedor.
     *
     * @param int $resellerId
     * @return array
     */
    public function getByResellerId($resellerId)
    {
        return $this->where('reseller_id', $resellerId)->findAll();
    }
}