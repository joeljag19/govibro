<?php
namespace App\Modules\Commissions\Models;

use CodeIgniter\Model;

class AuditLogModel extends Model
{
    protected $table = 'audit_logs';
    protected $primaryKey = 'id';
    protected $allowedFields = [
        'user_id',
        'action',
        'entity_type',
        'entity_id',
        'details',
        'created_at'
    ];
    protected $useTimestamps = false;

    /**
     * Registra un evento en el log de auditoría.
     *
     * @param int $userId
     * @param string $action
     * @param string|null $entityType
     * @param int|null $entityId
     * @param array|null $details
     * @return void
     */
    public function log($userId, $action, $entityType = null, $entityId = null, $details = null)
    {
        $data = [
            'user_id' => $userId,
            'action' => $action,
            'entity_type' => $entityType,
            'entity_id' => $entityId,
            'details' => $details ? json_encode($details) : null,
            'created_at' => date('Y-m-d H:i:s')
        ];
        $this->insert($data);
    }
}