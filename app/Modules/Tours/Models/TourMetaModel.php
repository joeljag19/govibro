<?php

namespace App\Modules\Tours\Models;

use CodeIgniter\Model;

class TourMetaModel extends Model
{
    protected $table = 'tour_meta';
    protected $primaryKey = 'id';
    protected $allowedFields = [
        'tour_id', 'enable_person_types', 'person_types', 'enable_open_hours', 'open_hours',
        'enable_extra_price', 'extra_price', 'enable_service_fee', 'service_fees'
    ];
}