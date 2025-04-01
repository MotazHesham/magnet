<?php

namespace App\Http\Requests\Admin;

use App\Models\ProductReview;
use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreProductReviewRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('product_review_create');
    }

    public function rules()
    {
        return [
            'rate' => [
                'required',
                'integer',
                'min:-2147483648',
                'max:2147483647',
            ],
            'product_id' => [
                'required',
                'integer',
            ],
        ];
    }
}
