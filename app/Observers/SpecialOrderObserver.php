<?php

namespace App\Observers;

use App\Models\SpecialOrder; 

class SpecialOrderObserver
{
    public function created(SpecialOrder $model)
    { 
        $model->order_num = 'Spec-' . $model->id;
        $model->save();
    }
}
