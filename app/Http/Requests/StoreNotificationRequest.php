<?php

namespace App\Http\Requests;

use App\Models\Notification;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreNotificationRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('notification_create');
    }

    public function rules()
    {
        return [
            'type' => [
                'string',
                'required',
            ],
            'data' => [
                'required',
            ],
            'read_at' => [
                'date_format:' . config('panel.date_format') . ' ' . config('panel.time_format'),
                'nullable',
            ],
        ];
    }
}
