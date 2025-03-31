<?php

namespace App\Models;

use App\Traits\Auditable;
use DateTimeInterface;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CommissionHistory extends Model
{
    use SoftDeletes, Auditable, HasFactory;

    public $table = 'commission_histories';

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'store_id',
        'order_id',
        'order_detail_id',
        'admin_commission',
        'store_earning',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }

    public function store()
    {
        return $this->belongsTo(Store::class, 'store_id');
    }

    public function order()
    {
        return $this->belongsTo(Order::class, 'order_id');
    }

    public function order_detail()
    {
        return $this->belongsTo(OrderDetail::class, 'order_detail_id');
    }
}
