<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller; 
use App\Models\CustomerScratch; 
use Illuminate\Support\Facades\Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class CustomerScratchesController extends Controller
{
    public function index(Request $request)
    {
        abort_if(Gate::denies('customer_scratch_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = CustomerScratch::with(['user', 'scratch'])->select(sprintf('%s.*', (new CustomerScratch)->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate      = 'customer_scratch_show';
                $editGate      = 'customer_scratch_edit';
                $deleteGate    = 'customer_scratch_delete';
                $crudRoutePart = 'customer-scratches';

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
            $table->addColumn('user_name', function ($row) {
                return $row->user ? $row->user->name : '';
            });

            $table->addColumn('scratch_name', function ($row) {
                return $row->scratch ? $row->scratch->name : '';
            });

            $table->editColumn('used', function ($row) {
                return '<input type="checkbox" disabled ' . ($row->used ? 'checked' : null) . '>';
            });

            $table->rawColumns(['actions', 'placeholder', 'user', 'scratch', 'used']);

            return $table->make(true);
        }

        return view('admin.customerScratches.index');
    } 
}
