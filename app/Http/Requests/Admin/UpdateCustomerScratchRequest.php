<?php

namespace App\Http\Requests\Admin;

use App\Models\CustomerScratch;
use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateCustomerScratchRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('customer_scratch_edit');
    }

    public function rules()
    {
        return [
            'user_id' => [
                'required',
                'integer',
            ],
            'scratch_id' => [
                'required',
                'integer',
            ],
            'used' => [
                'required',
            ],
            'expire_at' => [
                'required',
                'date_format:' . config('panel.date_format'),
            ],
        ];
    }
}
