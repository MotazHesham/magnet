<?php

namespace App\Http\Requests;

use App\Models\StoreCity;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreStoreCityRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('store_city_create');
    }

    public function rules()
    {
        return [
            'store_id' => [
                'required',
                'integer',
            ],
            'city_id' => [
                'required',
                'integer',
            ],
            'price' => [
                'required',
            ],
        ];
    }
}
