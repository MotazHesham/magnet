<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller; 
use App\Http\Requests\Admin\UpdatePaymentMethodRequest;
use App\Models\PaymentMethod;
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

    public function edit(PaymentMethod $paymentMethod)
    {
        abort_if(Gate::denies('payment_method_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.paymentMethods.edit', compact('paymentMethod'));
    }

    public function update(UpdatePaymentMethodRequest $request, PaymentMethod $paymentMethod)
    {
        $paymentMethod->update($request->all());

        return redirect()->route('admin.payment-methods.index');
    } 
}
