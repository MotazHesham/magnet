<?php

namespace App\Http\Requests;

use App\Models\Coupon;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateCouponRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('coupon_edit');
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
                'unique:coupons,code,' . request()->route('coupon')->id,
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
