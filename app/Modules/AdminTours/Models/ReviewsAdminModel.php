<?php
namespace App\Modules\AdminTours\Models;

use App\Models\ReviewsModel;

class ReviewsAdminModel extends ReviewsModel
{
    /**
     * Obtener todas las reseñas eliminadas
     * @return array
     */
    public function getDeleted()
    {
        return $this->getAll(null, true);
    }

    /**
     * Sobreescribir softDelete para registrar en audit_logs
     * @param int $id ID de la reseña
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
                'action' => 'Eliminó reseña (soft delete)',
                'entity_type' => 'review',
                'entity_id' => $id,
                'details' => json_encode(['review_id' => $id]),
                'created_at' => date('Y-m-d H:i:s'),
            ]);
        }

        $this->db->transCommit();
        return $result;
    }

    /**
     * Sobreescribir restore para registrar en audit_logs
     * @param int $id ID de la reseña
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
                'action' => 'Restauró reseña',
                'entity_type' => 'review',
                'entity_id' => $id,
                'details' => json_encode(['review_id' => $id]),
                'created_at' => date('Y-m-d H:i:s'),
            ]);
        }

        $this->db->transCommit();
        return $result;
    }
}