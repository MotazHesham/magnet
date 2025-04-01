<?php

namespace App\Http\Requests\Admin;

use App\Models\ProductComplaint;
use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class MassDestroyProductComplaintRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('product_complaint_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'ids'   => 'required|array',
            'ids.*' => 'exists:product_complaints,id',
        ];
    }
}
