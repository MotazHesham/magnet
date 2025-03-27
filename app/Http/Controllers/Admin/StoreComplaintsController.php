<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyStoreComplaintRequest;
use App\Http\Requests\StoreStoreComplaintRequest;
use App\Http\Requests\UpdateStoreComplaintRequest;
use App\Models\Store;
use App\Models\StoreComplaint;
use App\Models\User;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class StoreComplaintsController extends Controller
{
    public function index(Request $request)
    {
        abort_if(Gate::denies('store_complaint_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = StoreComplaint::with(['store', 'user'])->select(sprintf('%s.*', (new StoreComplaint)->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate      = 'store_complaint_show';
                $editGate      = 'store_complaint_edit';
                $deleteGate    = 'store_complaint_delete';
                $crudRoutePart = 'store-complaints';

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

            $table->addColumn('user_name', function ($row) {
                return $row->user ? $row->user->name : '';
            });

            $table->editColumn('reason', function ($row) {
                return $row->reason ? $row->reason : '';
            });

            $table->rawColumns(['actions', 'placeholder', 'store', 'user']);

            return $table->make(true);
        }

        return view('admin.storeComplaints.index');
    }

    public function create()
    {
        abort_if(Gate::denies('store_complaint_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $stores = Store::pluck('store_name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $users = User::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.storeComplaints.create', compact('stores', 'users'));
    }

    public function store(StoreStoreComplaintRequest $request)
    {
        $storeComplaint = StoreComplaint::create($request->all());

        return redirect()->route('admin.store-complaints.index');
    }

    public function edit(StoreComplaint $storeComplaint)
    {
        abort_if(Gate::denies('store_complaint_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $stores = Store::pluck('store_name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $users = User::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $storeComplaint->load('store', 'user');

        return view('admin.storeComplaints.edit', compact('storeComplaint', 'stores', 'users'));
    }

    public function update(UpdateStoreComplaintRequest $request, StoreComplaint $storeComplaint)
    {
        $storeComplaint->update($request->all());

        return redirect()->route('admin.store-complaints.index');
    }

    public function show(StoreComplaint $storeComplaint)
    {
        abort_if(Gate::denies('store_complaint_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $storeComplaint->load('store', 'user');

        return view('admin.storeComplaints.show', compact('storeComplaint'));
    }

    public function destroy(StoreComplaint $storeComplaint)
    {
        abort_if(Gate::denies('store_complaint_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $storeComplaint->delete();

        return back();
    }

    public function massDestroy(MassDestroyStoreComplaintRequest $request)
    {
        $storeComplaints = StoreComplaint::find(request('ids'));

        foreach ($storeComplaints as $storeComplaint) {
            $storeComplaint->delete();
        }

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
