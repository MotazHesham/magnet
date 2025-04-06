<?php

namespace Database\Factories;

use App\Models\Product;
use App\Models\Store;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $stores = Store::pluck('id')->toArray(); 
        $discountTypes = array_keys(Product::DISCOUNT_TYPE_SELECT);
        $i = 1;
        return [ 
            'store_id' => $stores[array_rand($stores,1)],
            'name' => 'Product ' . $i++,  
            'refundable' => rand(0,1),
            'featured' => rand(0,1),
            'approved' => rand(0,1),
            'published'=> rand(0,1),
            'purchase_price' => rand(50,100),
            'unit_price' => rand(100,200),
            'discount' => rand(0,100),
            'discount_type' => $discountTypes[array_rand($discountTypes,1)],
            'current_stock' => rand(0,100), 
            'variant_product' => 0, 
            'rating' => rand(1,5),
        ];
    }
}
