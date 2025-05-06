<?php

namespace App\Http\Controllers\Admin\Coupon;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\MassDestroyCouponRequest;
use App\Http\Requests\Admin\StoreCouponRequest;
use App\Http\Requests\Admin\UpdateCouponRequest;
use App\Models\Coupon;
use App\Models\Store;
use Illuminate\Support\Facades\Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Utils\DataTableHandler;

class CouponsController extends Controller
{
    public function index(Request $request)
    {
        abort_if(Gate::denies('coupon_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $config = [
                'relations' => ['stores'],
                'columns' => [ 
                    'type' => function ($row) {
                        return $row->type ? Coupon::TYPE_SELECT[$row->type] : '';
                    }, 
                    'active' => [
                        'type' => 'checkbox',
                        'options' => [
                            'model' => Coupon::class,
                        ]
                    ],
                    'discount_type' => function ($row) {
                        return $row->discount_type ? Coupon::DISCOUNT_TYPE_SELECT[$row->discount_type] : '';
                    },
                    'stores' => [
                        'type' => 'relation-many',
                        'options' => [
                            'column' => 'store_name',
                        ]
                    ]
                ],
                'gates' => [
                    'view' => 'coupon_show',
                    'edit' => 'coupon_edit',
                    'delete' => 'coupon_delete'
                ],
                'crudRoutePart' => 'coupons',
                'rawColumns' => ['active', 'stores']
            ];

            $handler = new DataTableHandler(new Coupon(), $config);
            return $handler->handle($request);
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
