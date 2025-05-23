<?php

namespace App\Http\Requests\Admin;

use App\Models\Search;
use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateSearchRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('search_edit');
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
