<?php

namespace App\Http\Requests\Admin;

use App\Models\Attribute;
use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateAttributeRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('attribute_edit');
    }

    public function rules()
    {
        return [
            'name' => [
                'string',
                'required',
            ],
        ];
    }
}
