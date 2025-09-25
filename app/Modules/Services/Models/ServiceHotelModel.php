<?php
namespace App\Modules\Services\Models;

use CodeIgniter\Model;

class ServiceHotelModel extends Model
{
    protected $table = 'service_hotels';
    protected $primaryKey = 'service_id';
    protected $allowedFields = ['service_id', 'property_type', 'facilities', 'hotel_services'];
}