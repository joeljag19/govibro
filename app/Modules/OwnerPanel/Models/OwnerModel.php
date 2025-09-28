<?php
namespace App\Modules\OwnerPanel\Models;

use CodeIgniter\Model;

class OwnerModel extends Model
{
    protected $table         = 'owners';
    protected $primaryKey    = 'id';
    protected $allowedFields = [
        'user_id',
        'platform_commission_percentage',
        'company_name',
        'contact_phone',
        'currency' // 'DOP' 'USD o 'EUR'
    ];
    protected $useTimestamps = true;
}