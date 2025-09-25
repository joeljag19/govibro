<?php
namespace App\Models;

use CodeIgniter\Model;

class UserWishlistModel extends Model
{
    protected $table = 'user_wishlist';
    protected $primaryKey = 'id';
    protected $allowedFields = [
        'object_id', 'object_model', 'user_id', 'create_user', 'update_user'
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
     * Obtener todos los elementos en la lista de deseos
     * @param int $userId ID del usuario (opcional)
     * @param int $tourId ID del tour (opcional)
     * @return array
     */
    public function getAll($userId = null, $tourId = null)
    {
        $builder = $this->select('user_wishlist.*, tours.title as tour_title, users.name as user_name')
                        ->join('tours', 'tours.id = user_wishlist.object_id AND user_wishlist.object_model = "tour"', 'left')
                        ->join('users', 'users.id = user_wishlist.user_id', 'left');

        if ($userId) {
            $builder->where('user_wishlist.user_id', $userId);
        }

        if ($tourId) {
            $builder->where('user_wishlist.object_id', $tourId)
                    ->where('user_wishlist.object_model', 'tour');
        }

        return $builder->findAll();
    }

    /**
     * Añadir un tour a la lista de deseos
     * @param array $data Datos del elemento
     * @return int ID insertado
     */
    public function addToWishlist($data)
    {
        $data['created_at'] = date('Y-m-d H:i:s');
        $data['updated_at'] = date('Y-m-d H:i:s');
        $this->insert($data);
        return $this->db->insertID();
    }

    /**
     * Eliminar un tour de la lista de deseos
     * @param int $tourId ID del tour
     * @param int $userId ID del usuario
     * @return bool
     */
    public function removeFromWishlist($tourId, $userId)
    {
        return $this->where('object_id', $tourId)
                    ->where('object_model', 'tour')
                    ->where('user_id', $userId)
                    ->delete();
    }
}