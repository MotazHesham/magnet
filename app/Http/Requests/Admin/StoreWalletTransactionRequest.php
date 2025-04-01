<?php

namespace App\Http\Requests\Admin;

use App\Models\WalletTransaction;
use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreWalletTransactionRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('wallet_transaction_create');
    }

    public function rules()
    {
        return [
            'type' => [
                'required',
            ],
            'amount' => [
                'required',
            ],
            'payment_status' => [
                'required',
            ],
            'payment_method' => [
                'required',
            ],
        ];
    }
}
