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

class Store extends Model implements HasMedia
{
    use SoftDeletes, InteractsWithMedia, Auditable, HasFactory;

    public $table = 'stores';

    protected $appends = [
        'logo',
        'commercial_register',
    ];

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public const STORE_TYPE_SELECT = [
        'companies'   => 'شركات',
        'individuals' => 'فريلانس',
    ];

    protected $fillable = [
        'user_id',
        'store_type',
        'store_name',
        'description',
        'city_id',
        'address',
        'store_phone',
        'store_email',
        'domain',
        'identity_num',
        'commerical_register_num',
        'tax_number',
        'rating',
        'admin_to_pay',
        'latitude',
        'longitude',
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
        self::observe(new \App\Observers\StoreObserver);
    }
    public function registerMediaConversions(Media $media = null): void
    {
        $this->addMediaConversion('thumb')->fit('crop', 50, 50);
        $this->addMediaConversion('preview')->fit('crop', 120, 120);
    }

    public function storeOrders()
    {
        return $this->hasMany(Order::class, 'store_id', 'id');
    }

    public function storeSpecialOrders()
    {
        return $this->hasMany(SpecialOrder::class, 'store_id', 'id');
    }

    public function storeStoreWithdrawRequests()
    {
        return $this->hasMany(StoreWithdrawRequest::class, 'store_id', 'id');
    }

    public function storeCommissionHistories()
    {
        return $this->hasMany(CommissionHistory::class, 'store_id', 'id');
    }

    public function storeStoreCities()
    {
        return $this->hasMany(StoreCity::class, 'store_id', 'id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function getLogoAttribute()
    {
        $file = $this->getMedia('logo')->last();
        if ($file) {
            $file->url       = $file->getUrl();
            $file->thumbnail = $file->getUrl('thumb');
            $file->preview   = $file->getUrl('preview');
        }

        return $file;
    }

    public function city()
    {
        return $this->belongsTo(City::class, 'city_id');
    }

    public function getCommercialRegisterAttribute()
    {
        return $this->getMedia('commercial_register')->last();
    }

    public function categories()
    {
        return $this->belongsToMany(ProductCategory::class);
    }
}
