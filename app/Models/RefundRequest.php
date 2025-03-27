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

class RefundRequest extends Model implements HasMedia
{
    use SoftDeletes, InteractsWithMedia, Auditable, HasFactory;

    public $table = 'refund_requests';

    protected $appends = [
        'invoice_photo',
        'product_photo',
    ];

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public const REFUND_STATUS_SELECT = [
        'pending'  => 'قيد الانتظار',
        'approved' => 'تم الموافقة',
        'refunded' => 'تم الاسترجاع',
        'rejected' => 'مرفوض',
    ];

    protected $fillable = [
        'user_id',
        'special_order_id',
        'order_id',
        'order_detail_id',
        'store_id',
        'reason',
        'refund_amount',
        'store_approval',
        'admin_approval',
        'reject_reason',
        'refund_status',
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

    public function special_order()
    {
        return $this->belongsTo(SpecialOrder::class, 'special_order_id');
    }

    public function order()
    {
        return $this->belongsTo(Order::class, 'order_id');
    }

    public function order_detail()
    {
        return $this->belongsTo(OrderDetail::class, 'order_detail_id');
    }

    public function store()
    {
        return $this->belongsTo(Store::class, 'store_id');
    }

    public function getInvoicePhotoAttribute()
    {
        $file = $this->getMedia('invoice_photo')->last();
        if ($file) {
            $file->url       = $file->getUrl();
            $file->thumbnail = $file->getUrl('thumb');
            $file->preview   = $file->getUrl('preview');
        }

        return $file;
    }

    public function getProductPhotoAttribute()
    {
        $file = $this->getMedia('product_photo')->last();
        if ($file) {
            $file->url       = $file->getUrl();
            $file->thumbnail = $file->getUrl('thumb');
            $file->preview   = $file->getUrl('preview');
        }

        return $file;
    }
}
