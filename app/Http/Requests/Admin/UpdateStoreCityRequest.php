<?php

namespace App\Http\Requests\Admin;

use App\Models\StoreCity;
use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateStoreCityRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('store_city_edit');
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
