<?php

namespace App\Http\Requests;

use App\Models\CustomerPoint;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreCustomerPointRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('customer_point_create');
    }

    public function rules()
    {
        return [
            'user_id' => [
                'required',
                'integer',
            ],
            'points' => [
                'required',
                'integer',
                'min:-2147483648',
                'max:2147483647',
            ],
            'order_id' => [
                'required',
                'integer',
            ],
            'order_detail_id' => [
                'required',
                'integer',
            ],
            'product_id' => [
                'required',
                'integer',
            ],
            'product_quantity' => [
                'required',
                'integer',
                'min:-2147483648',
                'max:2147483647',
            ],
        ];
    }
}
