<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller; 
use App\Models\CouponUsage; 
use Illuminate\Support\Facades\Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class CouponUsagesController extends Controller
{
    public function index(Request $request)
    {
        abort_if(Gate::denies('coupon_usage_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = CouponUsage::with(['coupon', 'user', 'order'])->select(sprintf('%s.*', (new CouponUsage)->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate      = 'coupon_usage_show';
                $editGate      = 'coupon_usage_edit';
                $deleteGate    = 'coupon_usage_delete';
                $crudRoutePart = 'coupon-usages';

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
            $table->addColumn('coupon_name', function ($row) {
                return $row->coupon ? $row->coupon->name : '';
            });

            $table->addColumn('user_name', function ($row) {
                return $row->user ? $row->user->name : '';
            });

            $table->addColumn('order_order_num', function ($row) {
                return $row->order ? $row->order->order_num : '';
            });

            $table->editColumn('discount', function ($row) {
                return $row->discount ? $row->discount : '';
            });

            $table->rawColumns(['actions', 'placeholder', 'coupon', 'user', 'order']);

            return $table->make(true);
        }

        return view('admin.couponUsages.index');
    }

}
