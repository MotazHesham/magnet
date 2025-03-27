<?php

namespace App\Observers;

use App\Models\Order;
use App\Notifications\DataChangeEmailNotification;
use Illuminate\Support\Facades\Notification;

class OrderActionObserver
{
    public function created(Order $model)
    {
        $data  = ['action' => 'created', 'model_name' => 'Order'];
        $users = \App\Models\User::whereHas('roles', function ($q) {
            return $q->where('title', 'Admin');
        })->get();
        Notification::send($users, new DataChangeEmailNotification($data));
    }
}
