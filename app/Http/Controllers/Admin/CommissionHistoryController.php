<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\CommissionHistory;
use Illuminate\Support\Facades\Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class CommissionHistoryController extends Controller
{
    public function index(Request $request)
    {
        abort_if(Gate::denies('commission_history_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = CommissionHistory::with(['store', 'order', 'order_detail'])->select(sprintf('%s.*', (new CommissionHistory)->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate      = 'commission_history_show';
                $editGate      = 'commission_history_edit';
                $deleteGate    = 'commission_history_delete';
                $crudRoutePart = 'commission-histories';

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

            $table->addColumn('order_order_num', function ($row) {
                return $row->order ? $row->order->order_num : '';
            });

            $table->addColumn('order_detail_note', function ($row) {
                return $row->order_detail ? $row->order_detail->note : '';
            });

            $table->editColumn('admin_commission', function ($row) {
                return $row->admin_commission ? $row->admin_commission : '';
            });
            $table->editColumn('store_earning', function ($row) {
                return $row->store_earning ? $row->store_earning : '';
            });

            $table->rawColumns(['actions', 'placeholder', 'store', 'order', 'order_detail']);

            return $table->make(true);
        }

        return view('admin.commissionHistories.index');
    }

    public function show(CommissionHistory $commissionHistory)
    {
        abort_if(Gate::denies('commission_history_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $commissionHistory->load('store', 'order', 'order_detail');

        return view('admin.commissionHistories.show', compact('commissionHistory'));
    }
}
