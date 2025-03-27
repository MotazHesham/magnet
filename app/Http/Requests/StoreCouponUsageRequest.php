<?php

namespace App\Http\Requests;

use App\Models\CouponUsage;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreCouponUsageRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('coupon_usage_create');
    }

    public function rules()
    {
        return [];
    }
}
