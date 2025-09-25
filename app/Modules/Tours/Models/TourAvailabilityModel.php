<?php

namespace App\Modules\Tours\Models;

use CodeIgniter\Model;

class TourAvailabilityModel extends Model
{
    protected $table = 'tour_availability';
    protected $primaryKey = 'id';
    protected $allowedFields = ['tour_id', 'start_date', 'end_date', 'max_people', 'is_available', 'created_at'];

    // Obtener el número máximo de huéspedes por tour
    public function getMaxGuestsByTour($tourId)
    {
        $result = $this->selectMax('max_people')
                       ->where('tour_id', $tourId)
                       ->get()
                       ->getRow();
        return $result->max_people ?? null;
    }
}