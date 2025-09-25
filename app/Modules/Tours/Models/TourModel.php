<?php

namespace App\Modules\Tours\Models;

use App\Models\TourModel as BaseTourModel;

class TourModel extends BaseTourModel
{
    // Definir las tablas relacionadas
    protected $translationTable = 'tour_translations';
    protected $metaTable = 'tour_meta';
    protected $termTable = 'tour_terms';
    protected $termsTable = 'terms';
    protected $bookingsTable = 'bookings';
    protected $reviewsTable = 'reviews';
    protected $wishlistTable = 'user_wishlist';
    protected $transactionsTable = 'transactions';
    protected $commissionsTable = 'commissions';



    /**
     * Obtiene los tours publicados y aprobados con detalles, aplicando filtros y paginación.
     *
     * @param array $filters Filtros como 'search', 'categories', 'price_min', etc.
     * @return array
     */
    public function getFilteredTours(array $filters = [], bool $paginate = true)
    {
        $builder = $this->select('tours.*, tour_categories.name as category_name, locations.name as location_name, tours.map_lat, tours.map_lng')
                        ->join('tour_categories', 'tour_categories.id = tours.category_id', 'left')
                        ->join('locations', 'locations.id = tours.location_id', 'left')
                        ->where('tours.status', 'published')
                        ->where('tours.approval_status', 'approved')
                        ->where('tours.deleted_at IS NULL');

        // (El resto de tu lógica de filtros se mantiene igual)
        if (!empty($filters['search'])) {
            $builder->like('tours.title', $filters['search']);
        }
        if (!empty($filters['categories'])) {
            $builder->whereIn('tours.category_id', $filters['categories']);
        }
        if (isset($filters['price_min'])) {
            $builder->where('tours.price >=', $filters['price_min']);
        }
        if (isset($filters['price_max'])) {
            $builder->where('tours.price <=', $filters['price_max']);
        }

        if ($paginate) {
            return $builder->orderBy('tours.created_at', 'DESC')->paginate(9, 'tours');
        }
        
        return $builder->orderBy('tours.created_at', 'DESC')->findAll();
    }
    /**
     * Cuenta el número de tours por categoría para los filtros del frontend.
     *
     * @param int $categoryId
     * @return int
     */
    public function countToursByCategory($categoryId)
    {
        return $this->where('category_id', $categoryId)
                    ->where('status', 'published')
                    ->where('approval_status', 'approved')
                    ->where('deleted_at', null)
                    ->countAllResults();
    }

    /**
     * Obtiene todos los tours publicados.
     *
     * @return array
     */
    public function getPublishedTours()
    {
        return $this->where('status', 'published')
                    ->where('approval_status', 'approved')
                    ->where('deleted_at', null)
                    ->findAll();
    }

    /**
     * Inserta una nueva reserva.
     *
     * @param array $data Datos de la reserva
     * @param int|null $userId ID del usuario que realiza la acción
     * @return int ID de la reserva insertada
     */
    public function insertBooking($data, $userId = null)
    {
        $this->db->transBegin();

        $data['create_user'] = $userId;
        $data['created_at'] = date('Y-m-d H:i:s');
        $data['updated_at'] = date('Y-m-d H:i:s');
        $this->db->table($this->bookingsTable)->insert($data);
        $bookingId = $this->db->insertID();

        if ($bookingId) {
            $this->db->table('audit_logs')->insert([
                'user_id' => $userId,
                'action' => 'Creó reserva',
                'entity_type' => 'booking',
                'entity_id' => $bookingId,
                'details' => json_encode($data),
                'created_at' => date('Y-m-d H:i:s'),
            ]);
        }

        $this->db->transCommit();
        return $bookingId;
    }

    /**
     * Inserta una nueva transacción.
     *
     * @param array $data Datos de la transacción
     * @param int|null $userId ID del usuario que realiza la acción
     * @return int ID de la transacción insertada
     */
    public function insertTransaction($data, $userId = null)
    {
        $this->db->transBegin();

        $data['created_at'] = date('Y-m-d H:i:s');
        $this->db->table($this->transactionsTable)->insert($data);
        $transactionId = $this->db->insertID();

        if ($transactionId) {
            $this->db->table('audit_logs')->insert([
                'user_id' => $userId,
                'action' => 'Creó transacción',
                'entity_type' => 'transaction',
                'entity_id' => $transactionId,
                'details' => json_encode($data),
                'created_at' => date('Y-m-d H:i:s'),
            ]);
        }

        $this->db->transCommit();
        return $transactionId;
    }

    /**
     * Calcula la comisión aplicable para un tour.
     *
     * @param int $tourId
     * @param float $totalPrice
     * @return array
     */
    public function calculateCommission($tourId, $totalPrice)
    {
        // Buscar una comisión específica para el tour
        $commission = $this->db->table($this->commissionsTable)
                               ->where('tour_id', $tourId)
                               ->get()
                               ->getRowArray();

        // Si no hay una comisión específica, buscar una global
        if (!$commission) {
            $commission = $this->db->table($this->commissionsTable)
                                   ->where('tour_id IS NULL')
                                   ->get()
                                   ->getRowArray();
        }

        // Si no hay ninguna comisión, usar valores por defecto (0)
        if (!$commission) {
            return ['commission_amount' => 0, 'fixed_amount' => 0, 'percentage' => 0];
        }

        // Calcular la comisión según el tipo
        $fixed_amount = floatval($commission['fixed_amount']);
        $percentage = floatval($commission['percentage']);
        $commission_amount = 0;

        switch ($commission['type']) {
            case 'fixed':
                $commission_amount = $fixed_amount;
                break;
            case 'percentage':
                $commission_amount = ($percentage / 100) * $totalPrice;
                break;
            case 'combined':
                $commission_amount = $fixed_amount + (($percentage / 100) * $totalPrice);
                break;
        }

        return [
            'commission_amount' => $commission_amount,
            'fixed_amount' => $fixed_amount,
            'percentage' => $percentage,
        ];
    }

    /**
     * Obtiene una reserva por su ID.
     *
     * @param int $bookingId
     * @return array|null
     */
    public function getBookingById($bookingId)
    {
        return $this->db->table($this->bookingsTable)
                        ->where('id', $bookingId)
                        ->where('object_model', 'tour')
                        ->where('deleted_at', null)
                        ->get()
                        ->getRowArray();
    }

     /**
     * Obtiene todos los detalles de un solo tour para su página pública.
     *
     * @param int $id El ID del tour.
     * @return array|null
     */
    public function getTourDetails($id)
    {
        return $this->select('tours.*, tour_categories.name as category_name, locations.name as location_name')
                    ->join('tour_categories', 'tour_categories.id = tours.category_id', 'left')
                    ->join('locations', 'locations.id = tours.location_id', 'left')
                    ->where('tours.id', $id)
                    ->where('tours.status', 'published')
                    ->where('tours.approval_status', 'approved')
                    ->first();
    }

    // En app/Modules/Tours/Models/TourModel.php

    /**
     * Encuentra un tour publicado por su slug y devuelve todos sus detalles.
     *
     * @param string $slug El slug del tour para buscar.
     * @return array|null Los datos del tour o null si no se encuentra.
     */
    public function getTourBySlug(string $slug): ?array
    {
        return $this->select('tours.*, tour_categories.name as category_name, locations.name as location_name')
                    ->join('tour_categories', 'tour_categories.id = tours.category_id', 'left')
                    ->join('locations', 'locations.id = tours.location_id', 'left')
                    ->where('tours.slug', $slug)
                    ->where('tours.status', 'published')
                    ->first();
    }
}