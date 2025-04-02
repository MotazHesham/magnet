<?php

namespace App\Models;

use DateTimeInterface;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductStock extends Model
{
    use  HasFactory;

    public $table = 'product_stocks'; 

    protected $dates = [
        'created_at',
        'updated_at', 
    ];

    protected $fillable = [
        'variant',
        'sku', 
        'purchase_price', 
        'unit_price', 
        'stock', 
        'product_id', 
        'created_at',
        'updated_at', 
    ];

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    } 
    
    public function product(){
        return $this->belongsTo(Product::class, 'product_id', 'id');
    }
}
