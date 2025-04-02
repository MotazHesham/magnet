<?php

namespace Database\Seeders;

use App\Models\ProductCategory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        ProductCategory::create([ 
            'name' => [
                'en' => 'Mens',
                'ar' => 'رجالي'
            ],
        ]);
        ProductCategory::create([ 
            'name' => [
                'en' => 'Womens',
                'ar' => 'نسائي'
            ],
        ]);
        ProductCategory::create([ 
            'name' => [
                'en' => 'Kids',
                'ar' => 'أطفالي'
            ],
        ]);
    }
}
