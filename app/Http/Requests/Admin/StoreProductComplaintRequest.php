<?php

namespace App\Http\Requests\Admin;

use App\Models\ProductComplaint;
use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreProductComplaintRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('product_complaint_create');
    }

    public function rules()
    {
        return [];
    }
}
