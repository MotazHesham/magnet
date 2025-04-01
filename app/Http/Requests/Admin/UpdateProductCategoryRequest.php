<?php

namespace App\Http\Requests\Admin;

use App\Models\ProductCategory;
use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateProductCategoryRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('product_category_edit');
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
