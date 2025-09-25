<?php
namespace App\Modules\AdminTours\Models;

use App\Models\UserWishlistModel;

class UserWishlistAdminModel extends UserWishlistModel
{
    /**
     * Sobreescribir addToWishlist para registrar en audit_logs
     * @param array $data Datos del elemento
     * @param int $userId ID del usuario que realiza la acción
     * @return int ID insertado
     */
    public function addToWishlist($data, $userId = null)
    {
        $this->db->transBegin();

        $result = parent::addToWishlist($data);

        if ($result) {
            $this->db->table('audit_logs')->insert([
                'user_id' => $userId,
                'action' => 'Añadió tour a lista de deseos',
                'entity_type' => 'wishlist',
                'entity_id' => $result,
                'details' => json_encode($data),
                'created_at' => date('Y-m-d H:i:s'),
            ]);
        }

        $this->db->transCommit();
        return $result;
    }

    /**
     * Sobreescribir removeFromWishlist para registrar en audit_logs
     * @param int $tourId ID del tour
     * @param int $userId ID del usuario
     * @param int $adminUserId ID del usuario admin que realiza la acción
     * @return bool
     */
    public function removeFromWishlist($tourId, $userId, $adminUserId = null)
    {
        $this->db->transBegin();

        $result = parent::removeFromWishlist($tourId, $userId);

        if ($result) {
            $this->db->table('audit_logs')->insert([
                'user_id' => $adminUserId,
                'action' => 'Eliminó tour de lista de deseos',
                'entity_type' => 'wishlist',
                'entity_id' => 0,
                'details' => json_encode(['tour_id' => $tourId, 'user_id' => $userId]),
                'created_at' => date('Y-m-d H:i:s'),
            ]);
        }

        $this->db->transCommit();
        return $result;
    }
}