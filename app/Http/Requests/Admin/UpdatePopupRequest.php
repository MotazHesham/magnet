<?php

namespace App\Http\Requests\Admin;

use App\Models\Popup;
use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdatePopupRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('popup_edit');
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
