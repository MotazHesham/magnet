<?php

namespace App\Http\Requests\Admin;

use App\Models\CommissionHistory;
use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateCommissionHistoryRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('commission_history_edit');
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
