<?php

namespace App\Http\Requests\Admin;

use App\Models\Order;
use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreOrderRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('order_create');
    }

    public function rules()
    {
        return [
            'order_num' => [
                'string',
                'nullable',
            ],
            'payment_status' => [
                'required',
            ],
            'shipping_cost' => [
                'required',
            ],
        ];
    }
}
