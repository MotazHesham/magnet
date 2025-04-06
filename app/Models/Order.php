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
        'edfapay' => 'edfapay',
    ];

    public const SHIPPING_TYPE_SELECT = [
        'home_delivery'  => 'Home Delivery', 
        // maybe carrier in the future
    ];

    public const PAYMENT_STATUS_SELECT = [
        'paid'    => 'تم الدفع',
        'un_paid' => 'لم يتم الدفع',
    ];

    protected $fillable = [
        'order_num',
        'user_id',
        'store_id',
        'delivery_status',
        'payment_method',
        'payment_status',
        'payment_data',
        'shipping_address',
        'shipping_type',
        'coupon_discount',
        'shipping_cost', 
        'total',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public const DELIVERY_STATUS_SELECT = [
        'pending'              => 'قيد الانتظار',
        'store_approved'       => 'تم الموافقة من المتجر',
        'store_rejected'       => 'تم الرفض من المتجر',
        'preparing'            => 'تم الدفع و جاري التجهيز',
        'prepared'             => 'تم التجهيز',
        'on_delivery'          => 'تم إرساله للشحن',
        'delivered_from_store' => 'تم التسليم من المتجر',
        'canceled_from_client' => 'تم الإلغاء',
        'client_received'      => 'تم الإستلام',
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

    public function orderCouponUsages()
    {
        return $this->hasMany(CouponUsage::class, 'order_id', 'id');
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
