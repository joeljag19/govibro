<?php
namespace App\Modules\AdminTours\Models;

use App\Models\TermsModel;

class TermsAdminModel extends TermsModel
{
    /**
     * Obtener todos los términos eliminados
     * @return array
     */
    public function getDeleted()
    {
        return $this->getAll(true);
    }

    /**
     * Sobreescribir softDelete para registrar en audit_logs
     * @param int $id ID del término
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
                'action' => 'Eliminó término (soft delete)',
                'entity_type' => 'term',
                'entity_id' => $id,
                'details' => json_encode(['term_id' => $id]),
                'created_at' => date('Y-m-d H:i:s'),
            ]);
        }

        $this->db->transCommit();
        return $result;
    }

    /**
     * Sobreescribir restore para registrar en audit_logs
     * @param int $id ID del término
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
                'action' => 'Restauró término',
                'entity_type' => 'term',
                'entity_id' => $id,
                'details' => json_encode(['term_id' => $id]),
                'created_at' => date('Y-m-d H:i:s'),
            ]);
        }

        $this->db->transCommit();
        return $result;
    }

    /**
     * Obtiene todos los términos con el nombre de su atributo asociado.
     * @return array
     */
    public function getTermsWithAttributeName()
    {
        return $this->select('terms.*, attrs.name as attr_name')
                    ->join('attrs', 'attrs.id = terms.attr_id', 'left')
                    ->orderBy('terms.id', 'DESC')
                    ->paginate(15);
    }

}