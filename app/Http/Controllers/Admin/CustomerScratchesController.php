<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyCustomerScratchRequest;
use App\Http\Requests\StoreCustomerScratchRequest;
use App\Http\Requests\UpdateCustomerScratchRequest;
use App\Models\CustomerScratch;
use App\Models\Scratch;
use App\Models\User;
use Gate;
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

    public function create()
    {
        abort_if(Gate::denies('customer_scratch_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $users = User::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $scratches = Scratch::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.customerScratches.create', compact('scratches', 'users'));
    }

    public function store(StoreCustomerScratchRequest $request)
    {
        $customerScratch = CustomerScratch::create($request->all());

        return redirect()->route('admin.customer-scratches.index');
    }

    public function edit(CustomerScratch $customerScratch)
    {
        abort_if(Gate::denies('customer_scratch_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $users = User::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $scratches = Scratch::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $customerScratch->load('user', 'scratch');

        return view('admin.customerScratches.edit', compact('customerScratch', 'scratches', 'users'));
    }

    public function update(UpdateCustomerScratchRequest $request, CustomerScratch $customerScratch)
    {
        $customerScratch->update($request->all());

        return redirect()->route('admin.customer-scratches.index');
    }

    public function show(CustomerScratch $customerScratch)
    {
        abort_if(Gate::denies('customer_scratch_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $customerScratch->load('user', 'scratch');

        return view('admin.customerScratches.show', compact('customerScratch'));
    }

    public function destroy(CustomerScratch $customerScratch)
    {
        abort_if(Gate::denies('customer_scratch_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $customerScratch->delete();

        return back();
    }

    public function massDestroy(MassDestroyCustomerScratchRequest $request)
    {
        $customerScratches = CustomerScratch::find(request('ids'));

        foreach ($customerScratches as $customerScratch) {
            $customerScratch->delete();
        }

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
