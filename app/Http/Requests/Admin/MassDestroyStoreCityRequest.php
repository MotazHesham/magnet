<?php

namespace App\Http\Requests\Admin;

use App\Models\StoreCity;
use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class MassDestroyStoreCityRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('store_city_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'ids'   => 'required|array',
            'ids.*' => 'exists:store_cities,id',
        ];
    }
}
