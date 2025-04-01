<?php

namespace App\Http\Requests\Admin;

use App\Models\Product;
use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateProductRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('product_edit');
    }

    public function rules()
    {
        return [
            'name' => [
                'string',
                'required',
            ],
            'product_categories.*' => [
                'integer',
            ],
            'product_categories' => [
                'array',
            ],
            'weight' => [
                'numeric',
            ],
            'tags' => [
                'string',
                'nullable',
            ],
            'photos' => [
                'array',
            ],
            'purchase_price' => [
                'required',
            ],
            'unit_price' => [
                'required',
            ],
            'current_stock' => [
                'nullable',
                'integer',
                'min:-2147483648',
                'max:2147483647',
            ],
            'sku' => [
                'string',
                'nullable',
            ],
            'num_of_sale' => [
                'nullable',
                'integer',
                'min:-2147483648',
                'max:2147483647',
            ],
            'slug' => [
                'string',
                'required',
            ],
            'meta_title' => [
                'string',
                'nullable',
            ],
        ];
    }
}
