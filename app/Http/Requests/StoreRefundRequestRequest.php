<?php

namespace App\Http\Requests;

use App\Models\RefundRequest;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreRefundRequestRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('refund_request_create');
    }

    public function rules()
    {
        return [
            'user_id' => [
                'required',
                'integer',
            ],
        ];
    }
}
