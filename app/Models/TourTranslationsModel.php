<?php
namespace App\Models;

use CodeIgniter\Model;

class TourTranslationsModel extends Model
{
    protected $table = 'tour_translations';
    protected $primaryKey = 'id';
    protected $allowedFields = [
        'origin_id', 'locale', 'title', 'slug', 'content', 'short_desc',
        'address', 'faqs', 'include', 'exclude', 'itinerary', 'surrounding',
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
     * Obtener todas las traducciones de un tour
     * @param int $tourId ID del tour
     * @return array
     */
    public function getByTourId($tourId)
    {
        return $this->where('origin_id', $tourId)
                    ->findAll();
    }

    /**
     * Obtener una traducción específica
     * @param int $tourId ID del tour
     * @param string $locale Idioma
     * @return array|null
     */
    public function getTranslation($tourId, $locale)
    {
        return $this->where('origin_id', $tourId)
                    ->where('locale', $locale)
                    ->first();
    }
}