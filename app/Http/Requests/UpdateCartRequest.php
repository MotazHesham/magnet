<?php

namespace App\Http\Requests;

use App\Models\Cart;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateCartRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('cart_edit');
    }

    public function rules()
    {
        return [
            'temp_user_uid' => [
                'string',
                'nullable',
            ],
            'product_id' => [
                'required',
                'integer',
            ],
            'store_id' => [
                'required',
                'integer',
            ],
            'quantity' => [
                'required',
                'integer',
                'min:-2147483648',
                'max:2147483647',
            ],
            'note' => [
                'string',
                'nullable',
            ],
            'variant' => [
                'string',
                'nullable',
            ],
        ];
    }
}
