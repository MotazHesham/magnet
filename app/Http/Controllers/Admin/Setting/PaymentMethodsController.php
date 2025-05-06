<?php

namespace App\Http\Controllers\Admin\Setting;

use App\Http\Controllers\Controller;  
use App\Models\PaymentMethod;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Gate; 
use Symfony\Component\HttpFoundation\Response;

class PaymentMethodsController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('payment_method_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $paymentMethods = PaymentMethod::all();

        return view('admin.paymentMethods.index', compact('paymentMethods'));
    }  

    public function update(Request $request)
    { 
        foreach ($request->types as $type) {
            overWriteEnvFile($type, $request[$type]);
        }

        Artisan::call('cache:clear');
        toast(trans('flash.success'),'success');
        return redirect()->route('admin.payment-methods.index');
    } 
    
    public function update_status(Request $request){  
        $raw = PaymentMethod::findOrFail($request->id);
        $raw->active = $request->status; 
        $raw->save();
        return 1;
    }
}
