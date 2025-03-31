<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyCouponUsageRequest;
use App\Http\Requests\StoreCouponUsageRequest;
use App\Http\Requests\UpdateCouponUsageRequest;
use App\Models\Coupon;
use App\Models\CouponUsage;
use App\Models\Order;
use App\Models\User;
use Gate;
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

    public function create()
    {
        abort_if(Gate::denies('coupon_usage_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $coupons = Coupon::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $users = User::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $orders = Order::pluck('order_num', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.couponUsages.create', compact('coupons', 'orders', 'users'));
    }

    public function store(StoreCouponUsageRequest $request)
    {
        $couponUsage = CouponUsage::create($request->all());

        return redirect()->route('admin.coupon-usages.index');
    }

    public function edit(CouponUsage $couponUsage)
    {
        abort_if(Gate::denies('coupon_usage_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $coupons = Coupon::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $users = User::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $orders = Order::pluck('order_num', 'id')->prepend(trans('global.pleaseSelect'), '');

        $couponUsage->load('coupon', 'user', 'order');

        return view('admin.couponUsages.edit', compact('couponUsage', 'coupons', 'orders', 'users'));
    }

    public function update(UpdateCouponUsageRequest $request, CouponUsage $couponUsage)
    {
        $couponUsage->update($request->all());

        return redirect()->route('admin.coupon-usages.index');
    }

    public function show(CouponUsage $couponUsage)
    {
        abort_if(Gate::denies('coupon_usage_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $couponUsage->load('coupon', 'user', 'order');

        return view('admin.couponUsages.show', compact('couponUsage'));
    }

    public function destroy(CouponUsage $couponUsage)
    {
        abort_if(Gate::denies('coupon_usage_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $couponUsage->delete();

        return back();
    }

    public function massDestroy(MassDestroyCouponUsageRequest $request)
    {
        $couponUsages = CouponUsage::find(request('ids'));

        foreach ($couponUsages as $couponUsage) {
            $couponUsage->delete();
        }

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
