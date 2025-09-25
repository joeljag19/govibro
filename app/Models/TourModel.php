<?php
namespace App\Models;

use CodeIgniter\Model;

class TourModel extends Model
{
    protected $table = 'tours';
    protected $primaryKey = 'id';
    protected $allowedFields = [
        'title', 'slug', 'content', 'short_desc', 'image_id', 'banner_image_id', 'gallery',
        'video', 'category_id', 'location_id', 'address', 'map_lat', 'map_lng', 'map_zoom',
        'price', 'sale_price', 'duration', 'min_people', 'max_people', 'faqs', 'status',
        'publish_date', 'is_featured', 'include', 'exclude', 'itinerary', 'review_score',
        'commission_rate', 'created_by', 'updated_by', 'lang', 'origin_id', 'owner_id',
        'approval_status', 'default_state', 'enable_fixed_date', 'start_date', 'end_date',
        'last_booking_date', 'ical_import_url', 'surrounding', 'booking_type', 'limit_type',
        'capacity_type', 'capacity', 'pass_exprire_type', 'pass_exprire_at', 'pass_valid_for',
        'date_select_type', 'min_day_before_booking', 'deleted_at'
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
     * Obtener todos los tours (con opción de filtrar por eliminación suave)
     * @param string $lang Idioma para filtrar los tours
     * @param bool $includeDeleted Incluir tours eliminados
     * @return array
     */
    public function getAll($lang = 'en', $includeDeleted = false)
    {
        $builder = $this->select('tours.*, tour_categories.name as category_name')
                        ->join('tour_categories', 'tour_categories.id = tours.category_id', 'left')
                        ->where('tours.lang', $lang);

        if (!$includeDeleted) {
            $builder->where('tours.deleted_at', null);
        }

        return $builder->findAll();
    }

    /**
     * Obtener todos los tours con sus traducciones
     * @param string $lang Idioma para obtener traducciones
     * @param bool $includeDeleted Incluir tours eliminados
     * @return array
     */
    public function getAllWithTranslations($lang = 'en', $includeDeleted = false)
    {
        $builder = $this->select('tours.*, tour_categories.name as category_name, tour_translations.title as translated_title, tour_translations.content as translated_content')
                        ->join('tour_categories', 'tour_categories.id = tours.category_id', 'left')
                        ->join('tour_translations', "tour_translations.origin_id = tours.id AND tour_translations.locale = '$lang'", 'left');

        if (!$includeDeleted) {
            $builder->where('tours.deleted_at', null);
        }

        return $builder->findAll();
    }

    /**
     * Obtener un tour por ID
     * @param int $id ID del tour
     * @param string $lang Idioma para filtrar el tour
     * @param bool $includeDeleted Incluir tours eliminados
     * @return array|null
     */
    public function getById($id, $lang = 'en', $includeDeleted = false)
    {
        log_message('debug', 'Buscando tour con ID: ' . $id);
        
        $builder = $this->select('tours.*, tour_categories.name as category_name')
                        ->join('tour_categories', 'tour_categories.id = tours.category_id', 'left')
                        ->where('tours.id', $id);
    
        if (!$includeDeleted) {
            $builder->where('tours.deleted_at', null);
        }
    
        $result = $builder->first();
        log_message('debug', 'Resultado de getById para tour ID ' . $id . ': ' . print_r($result, true));
        return $result;
    }
    
    /**
     * Obtener un tour por ID con sus traducciones
     * @param int $id ID del tour
     * @param string $lang Idioma para obtener traducciones
     * @param bool $includeDeleted Incluir tours eliminados
     * @return array|null
     */
    public function getByIdWithTranslations($id, $lang = 'en', $includeDeleted = false)
    {
        $builder = $this->select('tours.*, tour_categories.name as category_name, tour_translations.title as translated_title, tour_translations.content as translated_content')
                        ->join('tour_categories', 'tour_categories.id = tours.category_id', 'left')
                        ->join('tour_translations', "tour_translations.origin_id = tours.id AND tour_translations.locale = '$lang'", 'left')
                        ->where('tours.id', $id);

        if (!$includeDeleted) {
            $builder->where('tours.deleted_at', null);
        }

        return $builder->first();
    }

    /**
     * Realizar una eliminación suave de un tour
     * @param int $id ID del tour
     * @return bool
     */
    public function softDelete($id)
    {
        return $this->update($id, ['deleted_at' => date('Y-m-d H:i:s')]);
    }

    /**
     * Restaurar un tour eliminado suavemente
     * @param int $id ID del tour
     * @return bool
     */
    public function restore($id)
    {
        return $this->update($id, ['deleted_at' => null]);
    }

    /**
     * Relación con tour_categories
     * @param int $tourId ID del tour
     * @return array|null
     */
    public function getCategory($tourId)
    {
        return $this->db->table('tour_categories')
                        ->where('id', $this->find($tourId)['category_id'])
                        ->get()
                        ->getRowArray();
    }

    /**
     * Relación con locations
     * @param int $tourId ID del tour
     * @return array|null
     */
    public function getLocation($tourId)
    {
        return $this->db->table('locations')
                        ->where('id', $this->find($tourId)['location_id'])
                        ->get()
                        ->getRowArray();
    }
}