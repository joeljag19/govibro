<?php
namespace App\Models;

use CodeIgniter\Model;

class TermsModel extends Model
{
    protected $table = 'terms';
    protected $primaryKey = 'id';
    protected $allowedFields = [
        'name', 'content', 'attr_id', 'slug', 'image_id', 'icon', 'deleted_at',
        'create_user', 'update_user', 'origin_id', 'lang'
    ];
    protected $useTimestamps = true;
    protected $createdField = 'created_at';
    protected $updatedField = 'updated_at';

    public function __construct()
    {
        parent::__construct();
        $this->db = \Config\Database::connect();
    }

    /**
     * Obtener todos los términos (con opción de filtrar por eliminación suave)
     * @param bool $includeDeleted Incluir términos eliminados
     * @return array
     */
    public function getAll($includeDeleted = false)
    {
        $builder = $this->select('terms.*, attrs.name as attr_name')
                        ->join('attrs', 'attrs.id = terms.attr_id', 'left');

        if (!$includeDeleted) {
            $builder->where('terms.deleted_at', null);
        }

        return $builder->findAll();
    }

    /**
     * Realizar una eliminación suave de un término
     * @param int $id ID del término
     * @return bool
     */
    public function softDelete($id)
    {
        return $this->update($id, ['deleted_at' => date('Y-m-d H:i:s')]);
    }

    /**
     * Restaurar un término eliminado suavemente
     * @param int $id ID del término
     * @return bool
     */
    public function restore($id)
    {
        return $this->update($id, ['deleted_at' => null]);
    }
}