<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        $this->call([
            PermissionsTableSeeder::class,
            RolesTableSeeder::class,
            PermissionRoleTableSeeder::class,
            UsersTableSeeder::class,
            RoleUserTableSeeder::class,
            ColorsTableSeeder::class,
            AttributeSeeder::class,
            CategorySeeder::class,
            NotificationTypeSeeder::class,
            EmailTemplateSeeder::class,
            PaymentMethodSeeder::class,
            OtpMethodSeeder::class,
            SmsTemplateSeeder::class,
            RegionSeeder::class,
            CitiesSeeder::class,
        ]);
    }
}
