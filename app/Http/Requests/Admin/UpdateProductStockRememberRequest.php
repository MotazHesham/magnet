<?php

namespace App\Http\Requests\Admin;

use App\Models\ProductStockRemember;
use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateProductStockRememberRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('product_stock_remember_edit');
    }

    public function rules()
    {
        return [];
    }
}
