<?php

namespace App\Http\Requests;

use App\Models\OtpMethod;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class MassDestroyOtpMethodRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('otp_method_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'ids'   => 'required|array',
            'ids.*' => 'exists:otp_methods,id',
        ];
    }
}
