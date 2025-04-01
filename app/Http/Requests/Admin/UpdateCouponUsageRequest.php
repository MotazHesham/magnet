<?php

namespace App\Http\Requests\Admin;

use App\Models\CouponUsage;
use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateCouponUsageRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('coupon_usage_edit');
    }

    public function rules()
    {
        return [
            'coupon_id' => [
                'required',
                'integer',
            ],
            'user_id' => [
                'required',
                'integer',
            ],
            'order_id' => [
                'required',
                'integer',
            ],
            'discount' => [
                'required',
            ],
        ];
    }
}
