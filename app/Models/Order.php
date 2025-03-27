<?php

namespace App\Models;

use App\Traits\Auditable;
use DateTimeInterface;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Order extends Model
{
    use SoftDeletes, Auditable, HasFactory;

    public $table = 'orders';

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public const PAYMENT_METHOD_SELECT = [
        'cash' => 'الدفع عند الأستلام',
    ];

    public const SHIPPING_TYPE_SELECT = [
        'seller_wise'  => 'seller_wise',
        'product_wise' => 'product_wise',
    ];

    public const PAYMENT_STATUS_SELECT = [
        'paid'    => 'تم الدفع',
        'un_paid' => 'لم يتم الدفع',
    ];

    public const DELIVERY_STATUS_SELECT = [
        'pending'     => 'قيد الانتظار',
        'preparing'   => 'جاري التجهيز',
        'prepared'    => 'تم التجهيز',
        'on_delivery' => 'تم إرساله للشحن',
        'delivered'   => 'تم التسليم',
        'canceled'    => 'تم الإلغاء',
    ];

    protected $fillable = [
        'combined_order_id',
        'order_num',
        'user_id',
        'store_id',
        'store_approval',
        'delivery_status',
        'payment_method',
        'payment_status',
        'payment_data',
        'shipping_address',
        'shipping_type',
        'coupon_discount',
        'total',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }

    public static function boot()
    {
        parent::boot();
        self::observe(new \App\Observers\OrderActionObserver);
    }

    public function orderOrderDetails()
    {
        return $this->hasMany(OrderDetail::class, 'order_id', 'id');
    }

    public function combined_order()
    {
        return $this->belongsTo(CombinedOrder::class, 'combined_order_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function store()
    {
        return $this->belongsTo(Store::class, 'store_id');
    }
}
