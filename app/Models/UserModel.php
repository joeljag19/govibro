<?php
namespace App\Models;

use CodeIgniter\Model;

class UserModel extends Model
{
    protected $table = 'users';
    protected $primaryKey = 'id';
    protected $allowedFields = [
        'name', 'email', 'password', 'role', 'status',
        'language', 'created_at', 'updated_at' // Añadimos 'language' por si se necesita para traducciones
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
     * Obtener un usuario por email
     * @param string $email Email del usuario
     * @return array|null
     */
    public function getByEmail($email)
    {
        return $this->where('email', $email)
                    ->where('status', 'active')
                    ->first();
    }

    /**
     * Obtener las reservas de un usuario
     * @param int $userId ID del usuario
     * @return array
     */
    public function getBookings($userId)
    {
        return $this->db->table('bookings')
                        ->where('customer_id', $userId)
                        ->where('deleted_at', null)
                        ->get()
                        ->getResultArray();
    }

    /**
     * Obtener las reseñas de un usuario
     * @param int $userId ID del usuario
     * @return array
     */
    public function getReviews($userId)
    {
        return $this->db->table('reviews')
                        ->where('author_id', $userId)
                        ->where('deleted_at', null)
                        ->get()
                        ->getResultArray();
    }

    /**
     * Obtener la lista de deseos de un usuario
     * @param int $userId ID del usuario
     * @return array
     */
    public function getWishlist($userId)
    {
        return $this->db->table('user_wishlist')
                        ->select('user_wishlist.*, tours.title as tour_title')
                        ->join('tours', 'tours.id = user_wishlist.object_id AND user_wishlist.object_model = "tour"', 'left')
                        ->where('user_wishlist.user_id', $userId)
                        ->get()
                        ->getResultArray();
    }


    public function getCandidatesByRole($role)
    {
        return $this->where('role', $role)->findAll();
    }

    public function updateRole($id, $newRole)
    {
        return $this->update($id, ['role' => $newRole]);
    }
}