<?php
namespace App\Modules\Commissions\Models;

use CodeIgniter\Model;

class SellerModel extends Model
{
    protected $table = 'sellers';
    protected $primaryKey = 'id';
    protected $allowedFields = ['user_id', 'reseller_id', 'commission_percentage', 'first_name', 'last_name', 'address', 'phone', 'identity_document', 'created_at', 'updated_at'];

    /**
     * Obtiene todos los vendedores asociados a un revendedor,
     * incluyendo detalles del usuario como nombre y email.
     *
     * @param int $resellerId
     * @return array
     */
    public function getSellersByResellerId($resellerId)
    {
        return $this->select('sellers.*, users.name as user_name, users.email as user_email')
                    ->join('users', 'users.id = sellers.user_id')
                    ->where('sellers.reseller_id', $resellerId)
                    ->orderBy('users.name', 'ASC')
                    ->findAll();
    }

    /**
     * Obtiene todos los vendedores asociados a un reseller.
     *
     * @param int $resellerId
     * @return array
     */
    public function getByResellerId($resellerId)
    {
        return $this->where('reseller_id', $resellerId)->findAll();
    }

    /**
     * Obtiene vendedores con su nombre de usuario y email.
     * Si se proporciona un ID de vendedor, devuelve solo ese vendedor.
     *
     * @param int|null $sellerId
     * @return array
     */
    public function getSellersWithDetails($sellerId = null)
    {
        $builder = $this->select('sellers.*, users.name as user_name, users.email as user_email')
                        ->join('users', 'users.id = sellers.user_id');

        if ($sellerId) {
            return $builder->where('sellers.id', $sellerId)->first();
        }

        return $builder->findAll();
    }



}