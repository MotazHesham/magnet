<?php

namespace App\Http\Requests;

use App\Models\ProductReview;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateProductReviewRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('product_review_edit');
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
