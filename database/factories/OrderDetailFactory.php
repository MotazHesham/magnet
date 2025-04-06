<?php

namespace Database\Factories;

use App\Models\Order;
use App\Models\Product;
use App\Models\Store;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\OrderDetail>
 */
class OrderDetailFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $stores = Store::pluck('id')->toArray(); 
        $orders = Order::pluck('id')->toArray(); 
        $products = Product::pluck('id')->toArray(); 
        $quantity = rand(1,5);
        $product = Product::find($products[array_rand($products,1)]);
        $order = Order::find($orders[array_rand($orders,1)]);
        $price = $product->unit_price * $quantity; 
        $order->total = $order->orderOrderDetails()->sum('price') +
                        $order->orderOrderDetails()->sum('tax') +
                        $order->shipping_cost; 
        $order->save();
        $vat = 14;
        return [
            'store_id' => $stores[array_rand($stores,1)],
            'order_id' => $order->id,
            'product_id' => $product->id,
            'tax' => ($price * $vat) / 100,
            'price' => $price,
            'purchase_price' => $product->purchase_price * $quantity, 
            'quantity' => $quantity, 
        ];
    }
}
