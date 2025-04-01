<?php

namespace App\Http\Requests\Admin;

use App\Models\StoreWithdrawRequest;
use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class MassDestroyStoreWithdrawRequestRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('store_withdraw_request_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'ids'   => 'required|array',
            'ids.*' => 'exists:store_withdraw_requests,id',
        ];
    }
}
