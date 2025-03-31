<?php

namespace App\Http\Requests;

use App\Models\NotificationType;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateNotificationTypeRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('notification_type_edit');
    }

    public function rules()
    {
        return [
            'user_type' => [
                'string',
                'required',
            ],
            'type' => [
                'string',
                'required',
            ],
            'name' => [
                'string',
                'required',
            ],
            'default_text' => [
                'required',
            ],
            'status' => [
                'required',
            ],
        ];
    }
}
