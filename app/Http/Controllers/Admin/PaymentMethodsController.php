<?php

namespace App\Http\Controllers\Admin;

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
            $this->overWriteEnvFile($type, $request[$type]);
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
    public function overWriteEnvFile($type, $val)
    { 
        $path = base_path('.env');
        if (file_exists($path)) {
            $val = '"' . trim($val) . '"';
            if (is_numeric(strpos(file_get_contents($path), $type)) && strpos(file_get_contents($path), $type) >= 0) {
                file_put_contents($path, str_replace(
                    $type . '="' . env($type) . '"',
                    $type . '=' . $val,
                    file_get_contents($path)
                ));
            } else {
                file_put_contents($path, file_get_contents($path) . "\r\n" . $type . '=' . $val);
            }
        } 
    }
}
