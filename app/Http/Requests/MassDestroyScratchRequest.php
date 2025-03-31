<?php

namespace App\Http\Requests;

use App\Models\Scratch;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class MassDestroyScratchRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('scratch_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'ids'   => 'required|array',
            'ids.*' => 'exists:scratches,id',
        ];
    }
}
