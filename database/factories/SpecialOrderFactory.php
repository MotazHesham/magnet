<?php

namespace Database\Factories;

use App\Models\ProductCategory;
use App\Models\SpecialOrder;
use App\Models\Store;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\SpecialOrder>
 */
class SpecialOrderFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $i = 1;
        $customers = User::where('user_type','customer')->get()->pluck('id')->toArray();
        $stores = Store::pluck('id')->toArray(); 
        $categories = ProductCategory::pluck('id')->toArray(); 
        $deliveryStatus = array_keys(SpecialOrder::DELIVERY_STATUS_SELECT);
        $paymentStatus = array_keys(SpecialOrder::PAYMENT_STATUS_SELECT);
        $paymentMethods = array_keys(SpecialOrder::PAYMENT_METHOD_SELECT);
        $offerPriceStatus = array_keys(SpecialOrder::OFFER_PRICE_STATUS_SELECT);
        $selectedCustomer = $customers[array_rand($customers,1)];
        $shippingCost = rand(10,50);
        $offer_price = rand(200,500);
        $vat = 14;
        $tax = ($offer_price * $vat) / 100;
        $user = User::find($selectedCustomer);

        $shippingAddress = null;
        $address = $user->userAddresses()->first();
        if($address){
            $shippingAddress = $address->decodeDetails();
        }
        return [ 
            'user_id' => $user->id,
            'store_id' => $stores[array_rand($stores,1)],
            'category_id' => $categories[array_rand($categories,1)],  
            'offer_price_status' => $offerPriceStatus[array_rand($offerPriceStatus,1)],
            'delivery_status' => $deliveryStatus[array_rand($deliveryStatus,1)],
            'payment_status' => $paymentStatus[array_rand($paymentStatus,1)],
            'payment_method' => $paymentMethods[array_rand($paymentMethods,1)], 
            'shipping_address' => $shippingAddress,  
            'shipping_cost' => rand(10,50),
            'offer_price' => $offer_price,
            'tax' => $tax,
            'total' => $offer_price + $tax + $shippingCost,
            'created_at' => randomCreatedAt(),
        ];
    }
}
