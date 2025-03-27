<?php

namespace App\Http\Requests;

use App\Models\RefundRequest;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class MassDestroyRefundRequestRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('refund_request_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'ids'   => 'required|array',
            'ids.*' => 'exists:refund_requests,id',
        ];
    }
}
