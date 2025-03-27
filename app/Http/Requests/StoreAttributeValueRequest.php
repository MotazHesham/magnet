<?php

namespace App\Http\Requests;

use App\Models\AttributeValue;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreAttributeValueRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('attribute_value_create');
    }

    public function rules()
    {
        return [
            'attribute_id' => [
                'required',
                'integer',
            ],
            'value' => [
                'string',
                'required',
            ],
        ];
    }
}
