<?php

namespace Database\Factories;

use App\Models\City;
use App\Models\Store;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Store>
 */
class StoreFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $faker = \Faker\Factory::create('ar_SA');
        $cities = City::pluck('id')->toArray(); 
        $created_at = randomCreatedAt();
        $storeTypes = array_keys(Store::STORE_TYPE_SELECT); 
        $user = User::create( [  
            'name' => $faker->name(),
            'email' => $faker->unique()->safeEmail() . rand(0,999),  
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            'approved' => rand(0,1),
            'phone' => '05' . rand(00000000,99999999),
            'user_type' => 'seller', 
            'city_id' => $cities[array_rand($cities,1)],
            'created_at' => $created_at,
        ]);
        return [
            'user_id' => $user->id,  
            'store_type' => $storeTypes[array_rand($storeTypes,1)], 
            'store_name' => $faker->company, 
            'city_id' => $cities[array_rand($cities,1)],
            'address' => $faker->address,
            'store_phone' => '05' . rand(00000000,99999999),
            'store_email' => $user->email, 
            'rating' => rand(1,5), 
            'latitude' => $faker->randomFloat(7, -90, 90),
            'longitude' => $faker->randomFloat(7, -180, 180),
            'created_at' => $created_at,
        ];
    }
}
