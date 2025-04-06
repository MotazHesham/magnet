<?php

namespace Database\Seeders;

use App\Models\Address;
use App\Models\Customer;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\Product;
use App\Models\RefundRequest;
use App\Models\SpecialOrder;
use App\Models\Store;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class InitSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Customer::factory()->count(50)->create();
        Address::factory()->count(50)->create();
        Store::factory()->count(50)->create();
        Product::factory()->count(100)->create();
        Order::factory()->count(20)->create();
        OrderDetail::factory()->count(100)->create();
        SpecialOrder::factory()->count(30)->create();
        RefundRequest::factory()->count(30)->create();
    }
}
