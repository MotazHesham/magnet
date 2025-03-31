<?php

namespace App\Http\Requests;

use App\Models\Scratch;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateScratchRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('scratch_edit');
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
                'unique:scratches,code,' . request()->route('scratch')->id,
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
