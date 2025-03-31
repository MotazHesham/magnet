<?php

namespace App\Http\Requests;

use App\Models\SpecialOrder;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateSpecialOrderRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('special_order_edit');
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
