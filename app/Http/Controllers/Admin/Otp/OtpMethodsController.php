<?php

namespace App\Http\Controllers\Admin\Otp;

use App\Http\Controllers\Controller;
use App\Models\OtpMethod;
use Illuminate\Support\Facades\Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class OtpMethodsController extends Controller
{
    public function index(Request $request)
    {
        abort_if(Gate::denies('otp_method_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $otpMethods = OtpMethod::all();

        return view('admin.otpMethods.index',compact('otpMethods'));
    }

    public function update_status(Request $request){
        $otpMethod = OtpMethod::findOrFail($request->id);
        $otpMethod->status = $request->status;
        $otpMethod->save();

        if($request->status == 1){ 
            OtpMethod::where('id','!=', $otpMethod->id)
                        ->where('status', 1)
                        ->update(['status' => 0]);
        }
        return 1;
    }
}
