<?php

namespace App\Http\Requests\Admin;

use App\Models\Coupon;
use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreCouponRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('coupon_create');
    }

    public function rules()
    {
        return [
            'type' => [
                'required',
            ],
            'name' => [
                'string',
                'nullable',
            ],
            'code' => [
                'string',
                'required',
                'unique:coupons',
            ],
            'discount' => [
                'numeric',
                'required',
                'min:0',
                'max:100',
            ],
            'start_date' => [
                'date_format:' . config('panel.date_format'),
                'nullable',
            ],
            'end_date' => [
                'date_format:' . config('panel.date_format'),
                'nullable',
            ],
            'stores.*' => [
                'integer',
            ],
            'stores' => [
                'array',
            ],
        ];
    }
}
