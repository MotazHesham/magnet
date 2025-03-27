<?php

namespace App\Http\Requests;

use App\Models\ProductReview;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class MassDestroyProductReviewRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('product_review_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'ids'   => 'required|array',
            'ids.*' => 'exists:product_reviews,id',
        ];
    }
}
