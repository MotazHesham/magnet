<?php

namespace App\Http\Requests\Admin;

use App\Models\ProductCategory; 
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Gate;

class StoreProductCategoryRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('product_category_create');
    }

    public function rules()
    {
        return [
            'name' => [
                'string',
                'required',
            ], 
            'order_level' => [
                'required',
                'integer',
                'min:-2147483648',
                'max:2147483647',
            ],
            'meta_title' => [
                'string',
                'nullable',
            ],
        ];
    }
}
