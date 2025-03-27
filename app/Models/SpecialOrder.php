<?php

namespace App\Models;

use App\Traits\Auditable;
use DateTimeInterface;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class SpecialOrder extends Model implements HasMedia
{
    use SoftDeletes, InteractsWithMedia, Auditable, HasFactory;

    public $table = 'special_orders';

    protected $appends = [
        'files',
    ];

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public const PAYMENT_METHOD_SELECT = [
        'cash' => 'الدفع عند الأستلام',
    ];

    public const PAYMENT_STATUS_SELECT = [
        'paid'    => 'تم الدفع',
        'un_paid' => 'لم يتم الدفع',
    ];

    public const OFFER_PRICE_STATUS_SELECT = [
        'pending'         => 'قيد الأنتظار',
        'price_set'       => 'تم التسعير',
        'customer_accept' => 'تم قبول عرض السعر',
        'paid'            => 'تم الدفع',
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
        'order_num',
        'user_id',
        'store_id',
        'color',
        'category_id',
        'variants',
        'description',
        'delivery_status',
        'offer_price_status',
        'payment_method',
        'payment_status',
        'payment_data',
        'shipping_address',
        'shipping_cost',
        'total',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }

    public function registerMediaConversions(Media $media = null): void
    {
        $this->addMediaConversion('thumb')->fit('crop', 50, 50);
        $this->addMediaConversion('preview')->fit('crop', 120, 120);
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function store()
    {
        return $this->belongsTo(Store::class, 'store_id');
    }

    public function getFilesAttribute()
    {
        return $this->getMedia('files');
    }

    public function category()
    {
        return $this->belongsTo(ProductCategory::class, 'category_id');
    }
}
