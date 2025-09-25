<?php
namespace App\Modules\AdminTours\Models;

use CodeIgniter\Model;

class TourMetaAdminModel extends Model
{
    protected $table = 'tour_meta';
    protected $primaryKey = 'id';
    protected $allowedFields = [
        'tour_id', 'enable_person_types', 'person_types', 'enable_open_hours', 'open_hours',
        'enable_extra_price', 'extra_price', 'enable_service_fee', 'service_fees',
        'created_at', 'updated_at'
    ];
    protected $useTimestamps = true;
    protected $createdField = 'created_at';
    protected $updatedField = 'updated_at';
}