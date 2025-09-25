<?php
namespace App\Modules\Services\Models;

use CodeIgniter\Model;

class ServiceTourModel extends Model
{
    protected $table = 'service_tours';
    protected $primaryKey = 'service_id';
    protected $allowedFields = ['service_id', 'duration_hours', 'tour_type', 'group_size', 'price_adult', 'price_child', 'included', 'excluded', 'itinerary', 'travel_styles', 'facilities'];
}