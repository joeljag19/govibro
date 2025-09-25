<?php

namespace App\Modules\Tours\Models;

use CodeIgniter\Model;

class LocationModel extends Model
{
    protected $table = 'locations';
    protected $primaryKey = 'id';
    protected $allowedFields = ['name'];

    // Obtener todas las ubicaciones como un mapa (id => name)
    public function getLocationMap()
    {
        $locations = $this->findAll();
        $locationMap = [];
        foreach ($locations as $location) {
            $locationMap[$location['id']] = $location['name'];
        }
        return $locationMap;
    }
}