<?php

namespace App\Http\Requests\Admin;

use App\Models\Customer;
use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateCustomerRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('customer_edit');
    }

    public function rules()
    {
        return [
            'name' => [
                'string',
                'required',
            ], 
            'phone' => [ 
                'unique:users,phone,'. request()->user_id,
                'regex:/^05\d{8}$/',
                'required'
            ],
            'email' => [ 
                'unique:users,email,'. request()->user_id,
                'nullable',
                'email',
            ],
        ];
    }
}
