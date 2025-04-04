<?php

namespace App\Http\Requests\Admin;

use App\Models\StoreWithdrawRequest;
use Illuminate\Support\Facades\Gate;
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
            'amount' => [
                'required',
            ], 
        ];
    }
}
