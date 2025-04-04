<?php

namespace Database\Factories;

use App\Models\City;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Customer>
 */
class CustomerFactory extends Factory
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
        $user = User::create( [  
            'name' => $faker->name(),
            'email' => $faker->unique()->safeEmail() . rand(0,999),  
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            'approved' => rand(0,1),
            'phone' => '05' . rand(00000000,99999999),
            'user_type' => 'customer', 
            'city_id' => $cities[array_rand($cities,1)],
            'created_at' => $created_at,
        ]);
        return [
            'user_id' => $user->id, 
            'created_at' => $created_at,
        ];
    }
}
