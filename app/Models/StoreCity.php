<?php

namespace App\Models;

use App\Traits\Auditable;
use DateTimeInterface;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class StoreCity extends Model
{
    use SoftDeletes, Auditable, HasFactory;

    public $table = 'store_cities';

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'store_id',
        'city_id',
        'price',
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

    public function city()
    {
        return $this->belongsTo(City::class, 'city_id');
    }
}
