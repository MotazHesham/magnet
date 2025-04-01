<?php

namespace App\Http\Requests\Admin;

use App\Models\StoreWithdrawRequest;
use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreStoreWithdrawRequestRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('store_withdraw_request_create');
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
