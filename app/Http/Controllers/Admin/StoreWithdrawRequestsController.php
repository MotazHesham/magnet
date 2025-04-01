<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\MassDestroyStoreWithdrawRequestRequest;
use App\Http\Requests\Admin\StoreStoreWithdrawRequestRequest;
use App\Http\Requests\Admin\UpdateStoreWithdrawRequestRequest;
use App\Models\Store;
use App\Models\StoreWithdrawRequest;
use Illuminate\Support\Facades\Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class StoreWithdrawRequestsController extends Controller
{
    public function index(Request $request)
    {
        abort_if(Gate::denies('store_withdraw_request_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = StoreWithdrawRequest::with(['store'])->select(sprintf('%s.*', (new StoreWithdrawRequest)->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate      = 'store_withdraw_request_show';
                $editGate      = 'store_withdraw_request_edit';
                $deleteGate    = 'store_withdraw_request_delete';
                $crudRoutePart = 'store-withdraw-requests';

                return view('partials.datatablesActions', compact(
                    'viewGate',
                    'editGate',
                    'deleteGate',
                    'crudRoutePart',
                    'row'
                ));
            });

            $table->editColumn('id', function ($row) {
                return $row->id ? $row->id : '';
            });
            $table->addColumn('store_store_name', function ($row) {
                return $row->store ? $row->store->store_name : '';
            });

            $table->editColumn('amount', function ($row) {
                return $row->amount ? $row->amount : '';
            });
            $table->editColumn('note', function ($row) {
                return $row->note ? $row->note : '';
            });
            $table->editColumn('status', function ($row) {
                return $row->status ? StoreWithdrawRequest::STATUS_SELECT[$row->status] : '';
            });

            $table->rawColumns(['actions', 'placeholder', 'store']);

            return $table->make(true);
        }

        return view('admin.storeWithdrawRequests.index');
    }

    public function create()
    {
        abort_if(Gate::denies('store_withdraw_request_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $stores = Store::pluck('store_name', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.storeWithdrawRequests.create', compact('stores'));
    }

    public function store(StoreStoreWithdrawRequestRequest $request)
    {
        $storeWithdrawRequest = StoreWithdrawRequest::create($request->all());

        return redirect()->route('admin.store-withdraw-requests.index');
    }

    public function edit(StoreWithdrawRequest $storeWithdrawRequest)
    {
        abort_if(Gate::denies('store_withdraw_request_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $stores = Store::pluck('store_name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $storeWithdrawRequest->load('store');

        return view('admin.storeWithdrawRequests.edit', compact('storeWithdrawRequest', 'stores'));
    }

    public function update(UpdateStoreWithdrawRequestRequest $request, StoreWithdrawRequest $storeWithdrawRequest)
    {
        $storeWithdrawRequest->update($request->all());

        return redirect()->route('admin.store-withdraw-requests.index');
    }

    public function show(StoreWithdrawRequest $storeWithdrawRequest)
    {
        abort_if(Gate::denies('store_withdraw_request_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $storeWithdrawRequest->load('store');

        return view('admin.storeWithdrawRequests.show', compact('storeWithdrawRequest'));
    }

    public function destroy(StoreWithdrawRequest $storeWithdrawRequest)
    {
        abort_if(Gate::denies('store_withdraw_request_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $storeWithdrawRequest->delete();

        return back();
    }

    public function massDestroy(MassDestroyStoreWithdrawRequestRequest $request)
    {
        $storeWithdrawRequests = StoreWithdrawRequest::find(request('ids'));

        foreach ($storeWithdrawRequests as $storeWithdrawRequest) {
            $storeWithdrawRequest->delete();
        }

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
