<?php

namespace App\Observers;

use App\Models\City;
use App\Models\Store;
use App\Models\StoreCity;

class StoreObserver
{
    public function created(Store $model)
    { 
        $storeCities = [];
        foreach(City::all() as $city){
            array_push($storeCities,[
                'store_id' => $model->id,
                'city_id' => $city->id,
                'price' => $city->shipping_cost,
            ]);
        }
        StoreCity::insert($storeCities);
    }
}
