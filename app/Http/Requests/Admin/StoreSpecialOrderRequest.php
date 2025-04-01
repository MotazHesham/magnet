<?php

namespace App\Http\Requests\Admin;

use App\Models\SpecialOrder;
use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreSpecialOrderRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('special_order_create');
    }

    public function rules()
    {
        return [
            'order_num' => [
                'string',
                'nullable',
            ],
            'user_id' => [
                'required',
                'integer',
            ],
            'store_id' => [
                'required',
                'integer',
            ],
            'files' => [
                'array',
            ],
            'color' => [
                'string',
                'nullable',
            ],
            'variations' => [
                'required',
            ],
            'delivery_status' => [
                'required',
            ],
            'offer_price_status' => [
                'required',
            ],
            'payment_status' => [
                'required',
            ],
        ];
    }
}
