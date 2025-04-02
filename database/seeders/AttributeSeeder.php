<?php

namespace Database\Seeders;

use App\Models\Attribute;
use App\Models\AttributeValue;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AttributeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $attribute1 = Attribute::create([
            'name' => [
                'en' => 'Sizes',
                'ar' => 'المقاسات'
            ],
        ]);

        AttributeValue::insert([
            ['attribute_id' => $attribute1->id , 'value' => 'صغير جدا - Xs'],
            ['attribute_id' => $attribute1->id , 'value' => 'صغير - S'],
            ['attribute_id' => $attribute1->id , 'value' => 'متوسط - M'],
            ['attribute_id' => $attribute1->id , 'value' => 'كبير - L'],
            ['attribute_id' => $attribute1->id , 'value' => 'كبير جدا- LX'],
        ]);
        
        $attribute2 = Attribute::create([
            'name' => [
                'en' => 'Material',
                'ar' => 'الخامة'
            ],
        ]);

        AttributeValue::insert([
            ['attribute_id' => $attribute2->id , 'value' => 'Fabric'],
            ['attribute_id' => $attribute2->id , 'value' => 'Cotton'], 
        ]);
    }
}
