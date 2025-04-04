<?php

namespace App\Http\Requests\Admin;

use App\Models\NotificationType;
use Illuminate\Support\Facades\Gate;
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
