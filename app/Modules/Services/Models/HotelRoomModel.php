<?php
namespace App\Modules\Services\Models;

use CodeIgniter\Model;

class HotelRoomModel extends Model
{
    protected $table = 'hotel_rooms';
    protected $primaryKey = 'id';
    protected $allowedFields = ['service_id', 'name', 'price', 'capacity_adults', 'capacity_children'];
}