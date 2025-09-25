<?php
namespace App\Models;

use CodeIgniter\Model;

class TourCategoriesTranslationsModel extends Model
{
    protected $table = 'tour_categories_translations';
    protected $primaryKey = 'id';
    protected $allowedFields = [
        'origin_id', 'locale', 'name', 'content', 'create_user', 'update_user'
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
     * Obtener todas las traducciones de una categoría
     * @param int $categoryId ID de la categoría
     * @return array
     */
    public function getByCategoryId($categoryId)
    {
        return $this->where('origin_id', $categoryId)
                    ->findAll();
    }

    /**
     * Obtener una traducción específica
     * @param int $categoryId ID de la categoría
     * @param string $locale Idioma
     * @return array|null
     */
    public function getTranslation($categoryId, $locale)
    {
        return $this->where('origin_id', $categoryId)
                    ->where('locale', $locale)
                    ->first();
    }
}