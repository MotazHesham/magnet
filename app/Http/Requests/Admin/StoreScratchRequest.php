<?php

namespace App\Http\Requests\Admin;

use App\Models\Scratch;
use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreScratchRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('scratch_create');
    }

    public function rules()
    {
        return [
            'name' => [
                'string',
                'required',
            ],
            'code' => [
                'string',
                'required',
                'unique:scratches',
            ],
            'discount_type' => [
                'required',
            ],
            'discount' => [
                'required',
            ],
            'expiration_days' => [
                'required',
                'integer',
                'min:-2147483648',
                'max:2147483647',
            ],
        ];
    }
}
