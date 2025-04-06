<?php

namespace Database\Factories;

use App\Models\Order;
use App\Models\Store;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Order>
 */
class OrderFactory extends Factory
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
        $deliveryStatus = array_keys(Order::DELIVERY_STATUS_SELECT);
        $paymentStatus = array_keys(Order::PAYMENT_STATUS_SELECT);
        $paymentMethods = array_keys(Order::PAYMENT_METHOD_SELECT);
        $selectedCustomer = $customers[array_rand($customers,1)];
        $shippingCost = rand(10,50);
        
        $user = User::find($selectedCustomer);

        $shippingAddress = null;
        $address = $user->userAddresses()->first();
        if($address){
            $shippingAddress = $address->decodeDetails();
        }
        return [
            'order_num' => 'Order-' . $i++,
            'user_id' => $user->id,
            'store_id' => $stores[array_rand($stores,1)],
            'delivery_status' => $deliveryStatus[array_rand($deliveryStatus,1)],
            'payment_status' => $paymentStatus[array_rand($paymentStatus,1)],
            'payment_method' => $paymentMethods[array_rand($paymentMethods,1)], 
            'shipping_address' => $shippingAddress,  
            'shipping_cost' => $shippingCost,
            'total' => $shippingCost,
            'created_at' => randomCreatedAt(),
        ];
    }
}
