<?php

namespace App\Models;

use DateTimeInterface;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CouponUsage extends Model
{
    use SoftDeletes, HasFactory;

    public $table = 'coupon_usages';

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'coupon_id',
        'user_id',
        'discount',
        'combined_order_id',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }

    public function coupon()
    {
        return $this->belongsTo(Coupon::class, 'coupon_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function combined_order()
    {
        return $this->belongsTo(CombinedOrder::class, 'combined_order_id');
    }
}
