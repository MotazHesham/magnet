<?php

namespace App\Http\Requests;

use App\Models\CommissionHistory;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreCommissionHistoryRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('commission_history_create');
    }

    public function rules()
    {
        return [
            'store_id' => [
                'required',
                'integer',
            ],
            'order_id' => [
                'required',
                'integer',
            ],
            'order_detail_id' => [
                'required',
                'integer',
            ],
            'admin_commission' => [
                'required',
            ],
            'store_earning' => [
                'required',
            ],
        ];
    }
}
