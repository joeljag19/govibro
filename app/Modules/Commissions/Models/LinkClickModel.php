<?php
namespace App\Modules\Commissions\Models;

use CodeIgniter\Model;

class LinkClickModel extends Model
{
    protected $table         = 'link_clicks';
    protected $primaryKey    = 'id';
    protected $allowedFields = [
        'tracking_link_id',
        'reseller_id',
        'seller_id',
        'user_id',
        'ip_address',
        'user_agent',
        'created_at'
    ];
}