<?php

namespace App\Http\Requests;

use App\Models\Popup;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StorePopupRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('popup_create');
    }

    public function rules()
    {
        return [
            'title' => [
                'string',
                'nullable',
            ],
        ];
    }
}
