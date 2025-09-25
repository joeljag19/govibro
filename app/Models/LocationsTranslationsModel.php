<?php
namespace App\Models;

use CodeIgniter\Model;

class LocationsTranslationsModel extends Model
{
    protected $table = 'locations_translations';
    protected $primaryKey = 'id';
    protected $allowedFields = [
        'origin_id', 'locale', 'name', 'content', 'trip_ideas',
        'create_user', 'update_user'
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
     * Obtener todas las traducciones de una ubicación
     * @param int $locationId ID de la ubicación
     * @return array
     */
    public function getByLocationId($locationId)
    {
        return $this->where('origin_id', $locationId)
                    ->findAll();
    }

    /**
     * Obtener una traducción específica
     * @param int $locationId ID de la ubicación
     * @param string $locale Idioma
     * @return array|null
     */
    public function getTranslation($locationId, $locale)
    {
        return $this->where('origin_id', $locationId)
                    ->where('locale', $locale)
                    ->first();
    }
}