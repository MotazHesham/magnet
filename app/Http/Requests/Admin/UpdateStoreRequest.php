<?php

namespace App\Http\Requests\Admin;

use App\Models\Store;
use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateStoreRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('store_edit');
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
                'required',
                'email',
            ],
            'store_name' => [
                'string',
                'required',
            ],
            'logo' => [
                'required',
            ],
            'address' => [
                'string',
                'nullable',
            ],
            'store_phone' => [
                'string',
                'nullable',
            ],
            'domain' => [
                'string',
                'nullable',
            ],
            'categories.*' => [
                'integer',
            ],
            'categories' => [
                'array',
            ],
            'identity_num' => [
                'string',
                'nullable',
            ],
            'commerical_register_num' => [
                'string',
                'nullable',
            ],
            'tax_number' => [
                'string',
                'nullable',
            ],
            'rating' => [
                'numeric',
            ],
            'latitude' => [
                'string',
                'nullable',
            ],
            'longitude' => [
                'string',
                'nullable',
            ],
        ];
    }
}
