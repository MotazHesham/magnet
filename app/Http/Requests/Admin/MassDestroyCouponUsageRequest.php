<?php

namespace App\Http\Requests\Admin;

use App\Models\CouponUsage;
use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class MassDestroyCouponUsageRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('coupon_usage_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'ids'   => 'required|array',
            'ids.*' => 'exists:coupon_usages,id',
        ];
    }
}
