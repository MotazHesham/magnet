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
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;

class Product extends Model implements HasMedia
{
    use SoftDeletes, InteractsWithMedia, Auditable, HasFactory;
    use HasSlug;
    public $table = 'products';

    protected $appends = [
        'main_photo',
        'photos',
    ];

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public const DISCOUNT_TYPE_SELECT = [
        'percentage' => 'نسبة',
        'amount'     => 'قيمة',
    ];

    protected $fillable = [
        'store_id',
        'name',
        'brand_id',
        'weight',
        'tags',
        'description',
        'refundable',
        'featured',
        'approved',
        'published',
        'purchase_price',
        'unit_price',
        'discount',
        'discount_type',
        'current_stock',
        'sku',
        'variant_product',
        'attributes',
        'choice_options',
        'colors',
        'num_of_sale',
        'rating',
        'slug',
        'meta_title',
        'meta_description',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }

    public function getSlugOptions() : SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom('name')
            ->saveSlugsTo('slug');
    }
    public function registerMediaConversions(Media $media = null): void
    {
        $this->addMediaConversion('thumb')->fit('crop', 50, 50);
        $this->addMediaConversion('preview')->fit('crop', 120, 120);
    }

    public function total_stock(){
        if($this->variant_product){
            return $this->stocks()->sum('stock');
        }else{
            return $this->current_stock;
        }
    }
    public function orderOrderDetails()
    {
        return $this->hasMany(OrderDetail::class, 'product_id', 'id');
    }
    public function productProductReviews()
    {
        return $this->hasMany(ProductReview::class, 'product_id', 'id');
    }

    public function productProductComplaints()
    {
        return $this->hasMany(ProductComplaint::class, 'product_id', 'id');
    }

    public function favorites()
    {
        return $this->hasMany(ProductFavorite::class, 'product_id', 'id');
    }

    public function carts()
    {
        return $this->hasMany(Cart::class, 'product_id', 'id');
    }

    public function store()
    {
        return $this->belongsTo(Store::class, 'store_id');
    }

    public function product_categories()
    {
        return $this->belongsToMany(ProductCategory::class);
    }

    public function brand()
    {
        return $this->belongsTo(Brand::class, 'brand_id');
    }

    public function stocks(){
        return $this->hasMany(ProductStock::class, 'product_id', 'id');
    }

    public function getMainPhotoAttribute()
    {
        $file = $this->getMedia('main_photo')->last();
        if ($file) {
            $file->url       = $file->getUrl();
            $file->thumbnail = $file->getUrl('thumb');
            $file->preview   = $file->getUrl('preview');
        }

        return $file;
    }

    public function getPhotosAttribute()
    {
        $files = $this->getMedia('photos');
        $files->each(function ($item) {
            $item->url       = $item->getUrl();
            $item->thumbnail = $item->getUrl('thumb');
            $item->preview   = $item->getUrl('preview');
        });

        return $files;
    } 
}
