<?php
namespace App\Models;

use CodeIgniter\Model;

class LocationModel extends Model
{
    protected $table = 'bravo_locations';
    protected $primaryKey = 'id';
    protected $allowedFields = ['name', 'slug', 'image_id', 'status', 'created_at', 'updated_at'];

    protected $useTimestamps = true;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';

    /**
     * Obtener ubicaciones con límite
     *
     * @param int $limit
     * @return array
     */
    public function getLocations($limit = 6)
    {
        return $this->where('status', 'publish')
                    ->limit($limit)
                    ->findAll();
    }
}