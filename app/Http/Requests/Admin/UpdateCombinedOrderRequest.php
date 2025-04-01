<?php

namespace App\Http\Requests\Admin;

use App\Models\CombinedOrder;
use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateCombinedOrderRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('combined_order_edit');
    }

    public function rules()
    {
        return [
            'order_num' => [
                'string',
                'nullable',
            ],
        ];
    }
}
