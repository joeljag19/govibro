<?php
namespace App\Modules\AdminTours\Models;

use App\Models\AttrsModel;

class AttrsAdminModel extends AttrsModel
{
    /**
     * Obtener todos los atributos eliminados
     * @return array
     */
    public function getDeleted()
    {
        return $this->getAll(true);
    }

    /**
     * Sobreescribir softDelete para registrar en audit_logs
     * @param int $id ID del atributo
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
                'action' => 'Eliminó atributo (soft delete)',
                'entity_type' => 'attr',
                'entity_id' => $id,
                'details' => json_encode(['attr_id' => $id]),
                'created_at' => date('Y-m-d H:i:s'),
            ]);
        }

        $this->db->transCommit();
        return $result;
    }

    /**
     * Sobreescribir restore para registrar en audit_logs
     * @param int $id ID del atributo
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
                'action' => 'Restauró atributo',
                'entity_type' => 'attr',
                'entity_id' => $id,
                'details' => json_encode(['attr_id' => $id]),
                'created_at' => date('Y-m-d H:i:s'),
            ]);
        }

        $this->db->transCommit();
        return $result;
    }
}