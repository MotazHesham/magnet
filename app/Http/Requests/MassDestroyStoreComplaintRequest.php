<?php

namespace App\Http\Requests;

use App\Models\StoreComplaint;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class MassDestroyStoreComplaintRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('store_complaint_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'ids'   => 'required|array',
            'ids.*' => 'exists:store_complaints,id',
        ];
    }
}
