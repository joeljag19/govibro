<?php
namespace App\Modules\Services\Models;

use CodeIgniter\Model;

class ServiceModel extends Model
{
    protected $table = 'services';
    protected $primaryKey = 'id';
    protected $allowedFields = ['type', 'title', 'slug', 'description', 'price', 'image_id', 'location_id', 'status'];
    protected $useTimestamps = true;
}