<?php

namespace App\Http\Requests\Admin;

use App\Models\Product;
use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreProductRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('product_create');
    }

    public function rules()
    {
        $selectedAttributesIds = request()->input('attribute_options', []);
        $rules = [];
        $rules['name'] = 'required|string|max:255';
        $rules['product_categories.*'] = 'integer';
        $rules['product_categories'] = 'array|required';
        $rules['photos'] = 'array';
        $rules['purchase_price'] = 'required';
        $rules['unit_price'] = 'required';
        $rules['current_stock'] = 'nullable|integer';
        $rules['sku'] = 'string|nullable';
        $rules['meta_title'] = 'string|nullable';
        
        if($this->get('discount') > 0){
            $rules['discount_type'] = 'required';
        }
        
        if ($this->get('discount_type') == 'amount') {
            $rules['discount'] = 'sometimes|required|numeric|lt:unit_price';
        } else {
            $rules['discount'] = 'sometimes|required|numeric|lt:100';
        }
        foreach ($selectedAttributesIds as $id) {
            $rules["attribute_options_{$id}"] = ['required', 'array', 'min:1']; 
        }
        return $rules;
    }
}
