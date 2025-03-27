<?php

namespace App\Http\Requests;

use App\Models\StoreComplaint;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreStoreComplaintRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('store_complaint_create');
    }

    public function rules()
    {
        return [];
    }
}
