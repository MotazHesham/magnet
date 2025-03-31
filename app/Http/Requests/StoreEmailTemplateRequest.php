<?php

namespace App\Http\Requests;

use App\Models\EmailTemplate;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreEmailTemplateRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('email_template_create');
    }

    public function rules()
    {
        return [
            'user_type' => [
                'string',
                'required',
            ],
            'identifier' => [
                'string',
                'required',
            ],
            'email_type' => [
                'string',
                'required',
            ],
            'subject' => [
                'string',
                'required',
            ],
            'default_text' => [
                'required',
            ],
        ];
    }
}
