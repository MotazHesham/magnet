<?php

namespace App\Http\Requests\Admin;

use App\Models\NotificationType;
use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class MassDestroyNotificationTypeRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('notification_type_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'ids'   => 'required|array',
            'ids.*' => 'exists:notification_types,id',
        ];
    }
}
