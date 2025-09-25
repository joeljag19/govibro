<?php
namespace App\Modules\Services\Models;

use CodeIgniter\Model;

class ServiceBoatModel extends Model
{
    protected $table = 'service_boats';
    protected $primaryKey = 'id';
    protected $allowedFields = [
        'service_id',
        'max_guests',
        'cabins',
        'length',
        'speed',
        'created_at',
        'updated_at'
    ];

    protected $useTimestamps = true;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';

    /**
     * Obtener los detalles de un barco por el ID del servicio
     *
     * @param int $serviceId
     * @return array|null
     */
    public function getBoatDetailsByServiceId($serviceId)
    {
        return $this->where('service_id', $serviceId)->first();
    }

    /**
     * Obtener todos los barcos junto con la información del servicio
     *
     * @param array $filters Filtros opcionales (por ejemplo, location_id, price_range)
     * @param int $perPage Número de resultados por página
     * @param int $page Página actual
     * @return array
     */
    public function getBoatsWithService($filters = [], $perPage = 10, $page = 1)
    {
        $builder = $this->db->table('services')
            ->select('services.*, service_boats.max_guests, service_boats.cabins, service_boats.length, service_boats.speed')
            ->join('service_boats', 'service_boats.service_id = services.id', 'left')
            ->where('services.type', 'boat')
            ->where('services.status', 'publish');

        // Aplicar filtros
        if (!empty($filters['location_id'])) {
            $builder->where('services.location_id', $filters['location_id']);
        }
        if (!empty($filters['price_range'])) {
            $priceParts = explode(';', $filters['price_range']);
            $minPrice = $priceParts[0];
            $maxPrice = $priceParts[1];
            $builder->where('services.price >=', $minPrice);
            $builder->where('services.price <=', $maxPrice);
        }

        // Paginación
        $builder->limit($perPage, ($page - 1) * $perPage);

        return $builder->get()->getResultArray();
    }

    /**
     * Contar el número total de barcos que cumplen con los filtros
     *
     * @param array $filters Filtros opcionales
     * @return int
     */
    public function countBoats($filters = [])
    {
        $builder = $this->db->table('services')
            ->join('service_boats', 'service_boats.service_id = services.id', 'left')
            ->where('services.type', 'boat')
            ->where('services.status', 'publish');

        // Aplicar filtros
        if (!empty($filters['location_id'])) {
            $builder->where('services.location_id', $filters['location_id']);
        }
        if (!empty($filters['price_range'])) {
            $priceParts = explode(';', $filters['price_range']);
            $minPrice = $priceParts[0];
            $maxPrice = $priceParts[1];
            $builder->where('services.price >=', $minPrice);
            $builder->where('services.price <=', $maxPrice);
        }

        return $builder->countAllResults();
    }
}