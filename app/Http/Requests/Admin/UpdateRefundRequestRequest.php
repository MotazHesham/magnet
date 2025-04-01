<?php

namespace App\Http\Requests\Admin;

use App\Models\RefundRequest;
use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateRefundRequestRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('refund_request_edit');
    }

    public function rules()
    {
        return [
            'user_id' => [
                'required',
                'integer',
            ],
            'store_id' => [
                'required',
                'integer',
            ],
            'refund_amount' => [
                'required',
            ],
        ];
    }
}
