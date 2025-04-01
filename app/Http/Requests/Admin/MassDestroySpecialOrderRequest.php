<?php

namespace App\Http\Requests\Admin;

use App\Models\SpecialOrder;
use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class MassDestroySpecialOrderRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('special_order_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'ids'   => 'required|array',
            'ids.*' => 'exists:special_orders,id',
        ];
    }
}
