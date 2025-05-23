<?php

namespace App\Http\Requests\Admin;

use App\Models\Store;
use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class MassDestroyStoreRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('store_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'ids'   => 'required|array',
            'ids.*' => 'exists:stores,id',
        ];
    }
}
