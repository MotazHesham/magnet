<?php

namespace App\Http\Requests;

use App\Models\CustomerScratch;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class MassDestroyCustomerScratchRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('customer_scratch_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'ids'   => 'required|array',
            'ids.*' => 'exists:customer_scratches,id',
        ];
    }
}
