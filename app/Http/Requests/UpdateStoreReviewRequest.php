<?php

namespace App\Http\Requests;

use App\Models\StoreReview;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateStoreReviewRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('store_review_edit');
    }

    public function rules()
    {
        return [
            'rate' => [
                'nullable',
                'integer',
                'min:-2147483648',
                'max:2147483647',
            ],
        ];
    }
}
