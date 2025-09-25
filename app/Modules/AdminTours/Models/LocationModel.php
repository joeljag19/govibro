<?php
namespace App\Modules\AdminTours\Models;

use CodeIgniter\Model;

class LocationModel extends Model
{
    protected $table         = 'locations';
    protected $primaryKey    = 'id';
    protected $allowedFields = [
        'name', 
        'slug', 
        'content', 
        'image_id', 
        'map_lat', 
        'map_lng', 
        'map_zoom', 
        'status', 
        'parent_id', 
        'banner_image_id', 
        'trip_ideas', 
        'gallery',
        'lang',
        'origin_id'
    ];
    protected $useTimestamps = true;
    protected $useSoftDeletes = true;
}