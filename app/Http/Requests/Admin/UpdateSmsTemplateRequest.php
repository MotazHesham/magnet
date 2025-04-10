<?php

namespace App\Http\Requests\Admin;

use App\Models\SmsTemplate;
use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateSmsTemplateRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('sms_template_edit');
    }

    public function rules()
    {
        return [
            'identifier' => [
                'string',
                'required',
            ],
            'sms_body' => [
                'required',
            ],
            'templateid' => [
                'string',
                'nullable',
            ],
        ];
    }
}
