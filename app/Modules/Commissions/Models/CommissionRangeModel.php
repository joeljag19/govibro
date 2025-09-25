<?php
namespace App\Modules\Commissions\Models;

use CodeIgniter\Model;

class CommissionRangeModel extends Model
{
    protected $table         = 'commission_ranges';
    protected $primaryKey    = 'id';
    protected $allowedFields = [
        'profile_id',
        'start_day',
        'end_day',
        'reseller_share',
        'sequence'
    ];
}