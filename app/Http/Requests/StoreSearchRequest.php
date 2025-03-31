<?php

namespace App\Http\Requests;

use App\Models\Search;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreSearchRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('search_create');
    }

    public function rules()
    {
        return [
            'query' => [
                'string',
                'required',
            ],
            'count' => [
                'required',
                'integer',
                'min:-2147483648',
                'max:2147483647',
            ],
        ];
    }
}
