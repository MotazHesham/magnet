<?php

namespace App\Http\Requests\Admin;

use App\Models\NotificationType;
use Illuminate\Support\Facades\Gate;
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
        ];
    }
}
