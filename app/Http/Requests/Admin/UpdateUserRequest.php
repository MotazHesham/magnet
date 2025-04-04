<?php

namespace App\Http\Requests\Admin;

use App\Models\User;
use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateUserRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('user_edit');
    }

    public function rules()
    {
        return [
            'name' => [
                'string',
                'required',
            ], 
            'phone' => [ 
                'unique:users,phone,' . request()->route('user')->id,
                'regex:/^05\d{8}$/',
                'required'
            ],
            'email' => [ 
                'unique:users,email,' . request()->route('user')->id, 
                'required',
                'email',
            ],
        ];
    }
}
