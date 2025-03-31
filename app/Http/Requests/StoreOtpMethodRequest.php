<?php

namespace App\Http\Requests;

use App\Models\OtpMethod;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreOtpMethodRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('otp_method_create');
    }

    public function rules()
    {
        return [
            'type' => [
                'string',
                'required',
            ],
        ];
    }
}
