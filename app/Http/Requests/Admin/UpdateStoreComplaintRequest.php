<?php

namespace App\Http\Requests\Admin;

use App\Models\StoreComplaint;
use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateStoreComplaintRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('store_complaint_edit');
    }

    public function rules()
    {
        return [];
    }
}
