<?php

namespace App\Http\Requests\Admin;

use App\Models\StoreFollower;
use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateStoreFollowerRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('store_follower_edit');
    }

    public function rules()
    {
        return [];
    }
}
