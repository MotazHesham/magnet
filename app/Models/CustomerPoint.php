<?php

namespace App\Models;

use App\Traits\Auditable;
use DateTimeInterface;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CustomerPoint extends Model
{
    use SoftDeletes, Auditable, HasFactory;

    public $table = 'customer_points';

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'user_id',
        'points',
        'order_id',
        'order_detail_id',
        'product_id',
        'product_quantity',
        'refunded',
        'converted',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function order()
    {
        return $this->belongsTo(Order::class, 'order_id');
    }

    public function order_detail()
    {
        return $this->belongsTo(OrderDetail::class, 'order_detail_id');
    }

    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }
}
