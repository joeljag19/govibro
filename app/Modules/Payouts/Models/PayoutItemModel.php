<?php
namespace App\Modules\Payouts\Models;

use CodeIgniter\Model;

class PayoutItemModel extends Model
{
    protected $table         = 'payout_items';
    protected $primaryKey    = 'id';
    protected $allowedFields = [
        'payout_id',
        'sale_id',
        'commission_amount'
    ];

    protected $useTimestamps = false;
}
