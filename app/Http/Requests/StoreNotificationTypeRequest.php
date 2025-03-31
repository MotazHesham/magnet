<?php

namespace App\Http\Requests;

use App\Models\NotificationType;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreNotificationTypeRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('notification_type_create');
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
