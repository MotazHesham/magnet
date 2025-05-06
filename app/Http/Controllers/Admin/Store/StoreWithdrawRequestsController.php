<?php

namespace App\Http\Controllers\Admin\Store;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\MassDestroyStoreWithdrawRequestRequest;
use App\Http\Requests\Admin\StoreStoreWithdrawRequestRequest;
use App\Http\Requests\Admin\UpdateStoreWithdrawRequestRequest;
use App\Models\Store;
use App\Models\StoreWithdrawRequest;
use App\Utils\DataTableHandler;
use Illuminate\Support\Facades\Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class StoreWithdrawRequestsController extends Controller
{
    public function update_status(Request $request){
        if(!in_array($request->status,array_keys(StoreWithdrawRequest::STATUS_SELECT))){ 
            alert('Invalid status','','error'); 
            return redirect()->route('admin.store-withdraw-requests.index');
        }

        $store_withdraw_request = StoreWithdrawRequest::find($request->id);
        $store_withdraw_request->status = $request->status;
        
        $store = Store::find($store_withdraw_request->store_id);
        if($store->admin_to_pay < $store_withdraw_request->amount){
            alert(trans('flash.withdraw_requests.balance_not_enough'),'','error'); 
            return redirect()->route('admin.store-withdraw-requests.index');
        }
        if($request->status == 'paid'){ 
            $store->admin_to_pay -= $store_withdraw_request->amount;
            if($store->save()){
                $store_withdraw_request->save();
            }   
        }else{ 
            $store_withdraw_request->save();
        }

        toast(trans('flash.success'),'success');
        return redirect()->route('admin.store-withdraw-requests.index');
    }
    public function index(Request $request)
    { 
        abort_if(Gate::denies('store_withdraw_request_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $config = [
                'relations' => ['store'],
                'columns' => [
                    'store_store_name' => function ($row) {
                        return $row->store ? $row->store->store_name : '';
                    },
                    'status' => function ($row) {
                        return $row->status ? StoreWithdrawRequest::STATUS_SELECT[$row->status] : '';
                    }, 
                    'actions' => function ($row) {
                        $viewGate      = false;
                        $editGate      = $row->status == 'pending' ? 'store_withdraw_request_edit' : false;
                        $deleteGate    = $row->status == 'pending' ? 'store_withdraw_request_delete' : false;
                        $crudRoutePart = 'store-withdraw-requests';
        
                        $pay = '';
                        if ($row->status == 'pending' && Gate::allows('store_withdraw_request_edit')) {
                            $pay = '<a href="' . route('admin.store-withdraw-requests.update_status', ['id' => $row->id , 'paid']) . '" class="btn btn-warning btn-xs"
                                    onclick="return confirm(\'' . trans('global.areYouSure') . '\')">
                                    ' . trans('global.pay') . '
                                    </a>&nbsp;';
                        }
        
                        $reject = '';
                        if ($row->status == 'pending' && Gate::allows('store_withdraw_request_edit')) {
                            $reject = '<a href="' . route('admin.store-withdraw-requests.update_status', ['id' => $row->id , 'rejected']) . '" class="btn btn-dark btn-xs"
                                    onclick="return confirm(\'' . trans('global.areYouSure') . '\')">
                                    ' . trans('global.reject') . '
                                    </a>&nbsp;';
                        }
        
        
                        return $pay . $reject . view('partials.datatablesActions', compact(
                            'viewGate',
                            'editGate',
                            'deleteGate',
                            'crudRoutePart',
                            'row'
                        ));
                    },
                ],
                'gates' => [
                    'view' => false,
                    'edit' => 'store_withdraw_request_edit',
                    'delete' => 'store_withdraw_request_delete'
                ],
                'crudRoutePart' => 'store-withdraw-requests'
            ];

            $handler = new DataTableHandler(new StoreWithdrawRequest(), $config);
            return $handler->handle($request); 
        }

        return view('admin.store.storeWithdrawRequests.index');
    }

    public function create()
    {
        abort_if(Gate::denies('store_withdraw_request_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $stores = Store::pluck('store_name', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.store.storeWithdrawRequests.create', compact('stores'));
    }

    public function store(StoreStoreWithdrawRequestRequest $request)
    {
        $store = Store::find($request->store_id);
        if($store->admin_to_pay < $request->amount){
            return redirect()->back()->withErrors([trans('flash.withdraw_requests.balance_not_enough')]);
        }
        if(StoreWithdrawRequest::where('store_id',$store->id)->where('status','pending')->first()){
            return redirect()->back()->withErrors([trans('flash.withdraw_requests.cant_request_more')]);
        }
        StoreWithdrawRequest::create($request->all());

        return redirect()->route('admin.store-withdraw-requests.index');
    }

    public function edit(StoreWithdrawRequest $storeWithdrawRequest)
    {
        abort_if(Gate::denies('store_withdraw_request_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $stores = Store::pluck('store_name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $storeWithdrawRequest->load('store');

        return view('admin.store.storeWithdrawRequests.edit', compact('storeWithdrawRequest', 'stores'));
    }

    public function update(UpdateStoreWithdrawRequestRequest $request, StoreWithdrawRequest $storeWithdrawRequest)
    {
        $store = Store::find($storeWithdrawRequest->store_id);
        
        if($store->admin_to_pay < $request->amount){
            return redirect()->back()->withErrors([trans('flash.withdraw_requests.balance_not_enough')]);
        } 
        if($storeWithdrawRequest->status != 'pending'){
            return redirect()->back()->withErrors([trans('flash.cant_edit')]);
        }
        $storeWithdrawRequest->update($request->all());

        return redirect()->route('admin.store-withdraw-requests.index');
    }

    public function show(StoreWithdrawRequest $storeWithdrawRequest)
    {
        abort_if(Gate::denies('store_withdraw_request_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $storeWithdrawRequest->load('store');

        return view('admin.store.storeWithdrawRequests.show', compact('storeWithdrawRequest'));
    }

    public function destroy(StoreWithdrawRequest $storeWithdrawRequest)
    {
        abort_if(Gate::denies('store_withdraw_request_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if($storeWithdrawRequest->status != 'pending'){
            return redirect()->back()->withErrors([trans('flash.cant_delete')]);
        }
        $storeWithdrawRequest->delete();

        return back();
    } 
}
