<?php

namespace App\Http\Requests;

use App\Models\CombinedOrder;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class MassDestroyCombinedOrderRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('combined_order_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'ids'   => 'required|array',
            'ids.*' => 'exists:combined_orders,id',
        ];
    }
}
