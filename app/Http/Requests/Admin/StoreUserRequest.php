<?php

namespace App\Http\Requests\Admin;

use App\Models\User;
use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreUserRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('user_create');
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
                'required',
                'email',
            ],
        ];
    }
}
