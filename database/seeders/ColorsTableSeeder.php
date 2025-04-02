<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ColorsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $colors = [
            ['name' => 'Red', 'code' => '#FF0000'],
            ['name' => 'Green', 'code' => '#00FF00'],
            ['name' => 'Blue', 'code' => '#0000FF'],
            ['name' => 'Black', 'code' => '#000000'],
            ['name' => 'White', 'code' => '#FFFFFF'],
            ['name' => 'Yellow', 'code' => '#FFFF00'],
            ['name' => 'Purple', 'code' => '#800080'],
            ['name' => 'Cyan', 'code' => '#00FFFF'],
            ['name' => 'Magenta', 'code' => '#FF00FF'],
            ['name' => 'Orange', 'code' => '#FFA500'],
            ['name' => 'Pink', 'code' => '#FFC0CB'],
            ['name' => 'Brown', 'code' => '#A52A2A'],
            ['name' => 'Gray', 'code' => '#808080'],
            ['name' => 'Lime', 'code' => '#00FF00'],
            ['name' => 'Indigo', 'code' => '#4B0082'],
            ['name' => 'Gold', 'code' => '#FFD700'],
            ['name' => 'Silver', 'code' => '#C0C0C0'],
            ['name' => 'Teal', 'code' => '#008080'],
            ['name' => 'Olive', 'code' => '#808000'],
            ['name' => 'Maroon', 'code' => '#800000'],
            ['name' => 'Navy', 'code' => '#000080'],
            ['name' => 'Lavender', 'code' => '#E6E6FA'],
            ['name' => 'Turquoise', 'code' => '#40E0D0'],
            ['name' => 'Beige', 'code' => '#F5F5DC'],
            ['name' => 'Salmon', 'code' => '#FA8072'],
            ['name' => 'Crimson', 'code' => '#DC143C'],
            ['name' => 'Sky Blue', 'code' => '#87CEEB'],
            ['name' => 'Chocolate', 'code' => '#D2691E'],
        ];

        DB::table('colors')->insert($colors);
    }
}