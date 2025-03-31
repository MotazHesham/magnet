<?php

namespace App\Http\Requests;

use App\Models\CommissionHistory;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class MassDestroyCommissionHistoryRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('commission_history_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'ids'   => 'required|array',
            'ids.*' => 'exists:commission_histories,id',
        ];
    }
}
