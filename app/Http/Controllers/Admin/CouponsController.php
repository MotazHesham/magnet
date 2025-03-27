<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyCouponRequest;
use App\Http\Requests\StoreCouponRequest;
use App\Http\Requests\UpdateCouponRequest;
use App\Models\Coupon;
use App\Models\Store;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class CouponsController extends Controller
{
    public function index(Request $request)
    {
        abort_if(Gate::denies('coupon_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = Coupon::with(['stores'])->select(sprintf('%s.*', (new Coupon)->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate      = 'coupon_show';
                $editGate      = 'coupon_edit';
                $deleteGate    = 'coupon_delete';
                $crudRoutePart = 'coupons';

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
            $table->editColumn('type', function ($row) {
                return $row->type ? Coupon::TYPE_SELECT[$row->type] : '';
            });
            $table->editColumn('name', function ($row) {
                return $row->name ? $row->name : '';
            });
            $table->editColumn('code', function ($row) {
                return $row->code ? $row->code : '';
            });
            $table->editColumn('discount', function ($row) {
                return $row->discount ? $row->discount : '';
            });
            $table->editColumn('active', function ($row) {
                return '<input type="checkbox" disabled ' . ($row->active ? 'checked' : null) . '>';
            });
            $table->editColumn('discount_type', function ($row) {
                return $row->discount_type ? Coupon::DISCOUNT_TYPE_SELECT[$row->discount_type] : '';
            });

            $table->editColumn('stores', function ($row) {
                $labels = [];
                foreach ($row->stores as $store) {
                    $labels[] = sprintf('<span class="label label-info label-many">%s</span>', $store->store_name);
                }

                return implode(' ', $labels);
            });

            $table->rawColumns(['actions', 'placeholder', 'active', 'stores']);

            return $table->make(true);
        }

        return view('admin.coupons.index');
    }

    public function create()
    {
        abort_if(Gate::denies('coupon_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $stores = Store::pluck('store_name', 'id');

        return view('admin.coupons.create', compact('stores'));
    }

    public function store(StoreCouponRequest $request)
    {
        $coupon = Coupon::create($request->all());
        $coupon->stores()->sync($request->input('stores', []));

        return redirect()->route('admin.coupons.index');
    }

    public function edit(Coupon $coupon)
    {
        abort_if(Gate::denies('coupon_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $stores = Store::pluck('store_name', 'id');

        $coupon->load('stores');

        return view('admin.coupons.edit', compact('coupon', 'stores'));
    }

    public function update(UpdateCouponRequest $request, Coupon $coupon)
    {
        $coupon->update($request->all());
        $coupon->stores()->sync($request->input('stores', []));

        return redirect()->route('admin.coupons.index');
    }

    public function show(Coupon $coupon)
    {
        abort_if(Gate::denies('coupon_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $coupon->load('stores');

        return view('admin.coupons.show', compact('coupon'));
    }

    public function destroy(Coupon $coupon)
    {
        abort_if(Gate::denies('coupon_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $coupon->delete();

        return back();
    }

    public function massDestroy(MassDestroyCouponRequest $request)
    {
        $coupons = Coupon::find(request('ids'));

        foreach ($coupons as $coupon) {
            $coupon->delete();
        }

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
