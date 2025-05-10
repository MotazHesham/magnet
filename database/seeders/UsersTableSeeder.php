<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    public function run()
    {
        $users = [
            [
                'id'                 => 1,
                'name'               => 'Admin',
                'email'              => app()->isProduction() ? 'support@magnet.com' : 'admin@admin.com',
                'password'           => app()->isProduction() ? bcrypt('1L6cA8csSwrtgry') : bcrypt('password'),
                'remember_token'     => null,
                'approved'           => 1,
                'verified'           => 1,
                'verified_at'        => '2025-03-31 16:49:31',
                'verification_token' => '',
                'phone'              => '',
                'user_type'          => 'staff',
            ],
        ];

        User::insert($users);
    }
}
