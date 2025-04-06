<?php

namespace Database\Seeders;

use App\Models\OtpMethod;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class OtpMethodSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        OtpMethod::create([
            'type' => 'oursms',
            'status' => 0,
        ]);
        OtpMethod::create([
            'type' => 'twillo',
            'status' => 0,
        ]);
    }
}
