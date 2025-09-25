<?php
namespace App\Models;

use CodeIgniter\Model;

class ReviewsModel extends Model
{
    protected $table = 'reviews';
    protected $primaryKey = 'id';
    protected $allowedFields = [
        'object_id', 'object_model', 'title', 'content', 'rate_number', 'author_ip',
        'status', 'publish_date', 'create_user', 'update_user', 'deleted_at', 'lang',
        'vendor_id', 'author_id'
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
     * Obtener todas las reseñas (con opción de filtrar por eliminación suave)
     * @param int $tourId ID del tour (opcional)
     * @param bool $includeDeleted Incluir reseñas eliminadas
     * @return array
     */
    public function getAll($tourId = null, $includeDeleted = false)
    {
        $builder = $this->select('reviews.*, tours.title as tour_title, users.name as author_name')
                        ->join('tours', 'tours.id = reviews.object_id AND reviews.object_model = "tour"', 'left')
                        ->join('users', 'users.id = reviews.author_id', 'left');

        if (!$includeDeleted) {
            $builder->where('reviews.deleted_at', null);
        }

        if ($tourId) {
            $builder->where('reviews.object_id', $tourId)
                    ->where('reviews.object_model', 'tour');
        }

        return $builder->findAll();
    }

    /**
     * Realizar una eliminación suave de una reseña
     * @param int $id ID de la reseña
     * @return bool
     */
    public function softDelete($id)
    {
        return $this->update($id, ['deleted_at' => date('Y-m-d H:i:s')]);
    }

    /**
     * Restaurar una reseña eliminada suavemente
     * @param int $id ID de la reseña
     * @return bool
     */
    public function restore($id)
    {
        return $this->update($id, ['deleted_at' => null]);
    }
}