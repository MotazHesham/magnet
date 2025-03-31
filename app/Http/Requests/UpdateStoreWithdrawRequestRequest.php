<?php

namespace App\Http\Requests;

use App\Models\StoreWithdrawRequest;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateStoreWithdrawRequestRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('store_withdraw_request_edit');
    }

    public function rules()
    {
        return [
            'store_id' => [
                'required',
                'integer',
            ],
            'amount' => [
                'required',
            ],
            'status' => [
                'required',
            ],
        ];
    }
}
