<?php

namespace Database\Factories;

use App\Models\City;
use App\Models\District;
use App\Models\Region;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Address>
 */
class AddressFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $customers = User::where('user_type','customer')->get()->pluck('id')->toArray();
        $regois = Region::pluck('id')->toArray();
        $cities = City::pluck('id')->toArray();
        $districts = District::pluck('id')->toArray();
        $faker = \Faker\Factory::create('ar_SA');
        return [
            'user_id' => $customers[array_rand($customers,1)],
            'name' => 'Home',
            'region_id' => $regois[array_rand($regois,1)],
            'city_id' => $cities[array_rand($cities,1)],
            'district_id' => $districts[array_rand($districts,1)],
            'address' => $faker->address, 
            'latitude' => $faker->randomFloat(7, -90, 90),
            'longitude' => $faker->randomFloat(7, -180, 180),
        ];
    }
}
