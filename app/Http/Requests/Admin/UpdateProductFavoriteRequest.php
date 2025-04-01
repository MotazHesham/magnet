<?php

namespace App\Http\Requests\Admin;

use App\Models\ProductFavorite;
use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateProductFavoriteRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('product_favorite_edit');
    }

    public function rules()
    {
        return [];
    }
}
