<?php

namespace App\Http\Requests\Admin;

use App\Models\EmailTemplate;
use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateEmailTemplateRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('email_template_edit');
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
