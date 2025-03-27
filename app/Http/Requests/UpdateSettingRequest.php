<?php

namespace App\Http\Requests;

use App\Models\Setting;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateSettingRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('setting_edit');
    }

    public function rules()
    {
        return [
            'name' => [
                'string',
                'nullable',
            ],
            'key' => [
                'string',
                'required',
            ],
            'lang' => [
                'string',
                'nullable',
            ],
            'group_name' => [
                'string',
                'nullable',
            ],
            'order_level' => [
                'nullable',
                'integer',
                'min:-2147483648',
                'max:2147483647',
            ],
            'grid_col' => [
                'string',
                'nullable',
            ],
        ];
    }
}
