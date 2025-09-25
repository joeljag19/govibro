<?php
namespace App\Models;

use CodeIgniter\Model;

class AttrsModel extends Model
{
    protected $table = 'attrs';
    protected $primaryKey = 'id';
    protected $allowedFields = [
        'name', 'slug', 'service', 'hide_in_filter_search', 'position',
        'display_type', 'hide_in_single', 'deleted_at', 'create_user',
        'update_user', 'origin_id', 'lang'
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
     * Obtener todos los atributos (con opción de filtrar por eliminación suave)
     * @param bool $includeDeleted Incluir atributos eliminados
     * @return array
     */
    public function getAll($includeDeleted = false)
    {
        $builder = $this;

        if (!$includeDeleted) {
            $builder->where('deleted_at', null);
        }

        return $builder->findAll();
    }

    /**
     * Realizar una eliminación suave de un atributo
     * @param int $id ID del atributo
     * @return bool
     */
    public function softDelete($id)
    {
        return $this->update($id, ['deleted_at' => date('Y-m-d H:i:s')]);
    }

    /**
     * Restaurar un atributo eliminado suavemente
     * @param int $id ID del atributo
     * @return bool
     */
    public function restore($id)
    {
        return $this->update($id, ['deleted_at' => null]);
    }
}