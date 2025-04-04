<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;  
use App\Models\StoreComplaint; 
use Illuminate\Support\Facades\Gate;
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
                $viewGate      = false;
                $editGate      = false;
                $deleteGate    = false;
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
}
