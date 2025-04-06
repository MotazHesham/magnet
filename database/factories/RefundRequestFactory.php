<?php

namespace Database\Factories;

use App\Models\OrderDetail;
use App\Models\RefundRequest;
use App\Models\SpecialOrder;
use App\Models\Store;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\RefundRequest>
 */
class RefundRequestFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $customers = User::where('user_type','customer')->get()->pluck('id')->toArray();
        $stores = Store::pluck('id')->toArray(); 
        $refundStatus = array_keys(RefundRequest::REFUND_STATUS_SELECT);

        $widthdrawRequest = [
            'user_id' => $customers[array_rand($customers,1)],
            'store_id' => $stores[array_rand($stores,1)], 
            'store_approval' => rand(0,1),
            'admin_approval' => rand(0,1),  
            'refund_status' => $refundStatus[array_rand($refundStatus,1)], 
            'created_at' => randomCreatedAt(),
        ];

        if(rand(0,1)){ 
            $orderDetails = OrderDetail::pluck('id')->toArray();
            $orderDetail = OrderDetail::find($orderDetails[array_rand($orderDetails,1)]); 
            $widthdrawRequest['order_detail_id']  = $orderDetail->id; 
            $widthdrawRequest['order_id']  = $orderDetail->order_id;
            $widthdrawRequest['refund_amount']  = $orderDetail->price;
        }else{ 
            $specialOrders = SpecialOrder::pluck('id')->toArray();
            $specialOrder = SpecialOrder::find($specialOrders[array_rand($specialOrders,1)]); 
            $widthdrawRequest['special_order_id']  = $specialOrder->id;
            $widthdrawRequest['refund_amount']  = $specialOrder->total;
        }
        return $widthdrawRequest;
    }
}
