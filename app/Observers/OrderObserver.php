<?php

namespace App\Observers;

use App\Models\Order; 

class OrderObserver
{
    public function created(Order $model)
    { 
        $model->order_num = 'Ord-' . $model->id;
        $model->save();
    }
}
