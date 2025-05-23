<?php

namespace App\Http\Requests\Admin;

use App\Models\Customer;
use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreCustomerRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('customer_create');
    }

    public function rules()
    {
        return [
            'name' => [
                'string',
                'required',
            ],
            'password' => [
                'required',
            ], 
            'phone' => [ 
                'unique:users',
                'regex:/^05\d{8}$/',
                'required'
            ],
            'email' => [ 
                'unique:users', 
                'nullable',
                'email',
            ],
        ];
    }
}
