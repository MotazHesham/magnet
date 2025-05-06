<?php

namespace App\Http\Controllers\Admin\Store;

use App\Http\Controllers\Controller;
use App\Models\CommissionHistory;
use App\Utils\DataTableHandler;
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
            $config = [
                'relations' => ['store', 'order', 'order_detail'],
                'columns' => [
                    'store_store_name' => function ($row) {
                        return $row->store ? $row->store->store_name : '';
                    },
                    'order_order_num' => function ($row) {
                        return $row->order ? $row->order->order_num : '';
                    },
                    'order_detail_note' => function ($row) {
                        return $row->order_detail ? $row->order_detail->note : '';
                    }, 
                ],
                'gates' => [
                    'view' => false,
                    'edit' => false,
                    'delete' => false
                ],
                'crudRoutePart' => 'commission-histories'
            ];

            $handler = new DataTableHandler(new CommissionHistory(), $config);
            return $handler->handle($request);  
        }

        return view('admin.store.commissionHistories.index');
    } 
}
