<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyCombinedOrderRequest;
use App\Http\Requests\StoreCombinedOrderRequest;
use App\Http\Requests\UpdateCombinedOrderRequest;
use App\Models\CombinedOrder;
use App\Models\User;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class CombinedOrdersController extends Controller
{
    public function index(Request $request)
    {
        abort_if(Gate::denies('combined_order_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = CombinedOrder::with(['user'])->select(sprintf('%s.*', (new CombinedOrder)->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate      = 'combined_order_show';
                $editGate      = 'combined_order_edit';
                $deleteGate    = 'combined_order_delete';
                $crudRoutePart = 'combined-orders';

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
            $table->editColumn('order_num', function ($row) {
                return $row->order_num ? $row->order_num : '';
            });
            $table->editColumn('total', function ($row) {
                return $row->total ? $row->total : '';
            });
            $table->editColumn('shipping_address', function ($row) {
                return $row->shipping_address ? $row->shipping_address : '';
            });
            $table->addColumn('user_name', function ($row) {
                return $row->user ? $row->user->name : '';
            });

            $table->rawColumns(['actions', 'placeholder', 'user']);

            return $table->make(true);
        }

        return view('admin.combinedOrders.index');
    }

    public function create()
    {
        abort_if(Gate::denies('combined_order_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $users = User::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.combinedOrders.create', compact('users'));
    }

    public function store(StoreCombinedOrderRequest $request)
    {
        $combinedOrder = CombinedOrder::create($request->all());

        return redirect()->route('admin.combined-orders.index');
    }

    public function edit(CombinedOrder $combinedOrder)
    {
        abort_if(Gate::denies('combined_order_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $users = User::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $combinedOrder->load('user');

        return view('admin.combinedOrders.edit', compact('combinedOrder', 'users'));
    }

    public function update(UpdateCombinedOrderRequest $request, CombinedOrder $combinedOrder)
    {
        $combinedOrder->update($request->all());

        return redirect()->route('admin.combined-orders.index');
    }

    public function show(CombinedOrder $combinedOrder)
    {
        abort_if(Gate::denies('combined_order_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $combinedOrder->load('user', 'combinedOrderOrders');

        return view('admin.combinedOrders.show', compact('combinedOrder'));
    }

    public function destroy(CombinedOrder $combinedOrder)
    {
        abort_if(Gate::denies('combined_order_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $combinedOrder->delete();

        return back();
    }

    public function massDestroy(MassDestroyCombinedOrderRequest $request)
    {
        $combinedOrders = CombinedOrder::find(request('ids'));

        foreach ($combinedOrders as $combinedOrder) {
            $combinedOrder->delete();
        }

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
