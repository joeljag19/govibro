<?php
namespace App\Modules\AdminTours\Models;

use CodeIgniter\Model;

class TourCategoryModel extends Model
{
    protected $table         = 'tour_categories';
    protected $primaryKey    = 'id';
    protected $allowedFields = [
        'name', 
        'slug', 
        'content', 
        'status', 
        'parent_id',
        'lang',
        'origin_id'
    ];
    protected $useTimestamps = true;
    protected $useSoftDeletes = true;
}