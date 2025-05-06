<?php

namespace App\Http\Controllers\Admin\Coupon;

use App\Http\Controllers\Controller; 
use App\Models\CouponUsage; 
use Illuminate\Support\Facades\Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Utils\DataTableHandler;

class CouponUsagesController extends Controller
{
    public function index(Request $request)
    {
        abort_if(Gate::denies('coupon_usage_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $config = [
                'relations' => ['coupon', 'user', 'order'],
                'columns' => [ 
                    'coupon_name' => function ($row) {
                        return $row->coupon ? $row->coupon->name : '';
                    },
                    'user_name' => function ($row) {
                        return $row->user ? $row->user->name : '';
                    },
                    'order_order_num' => function ($row) {
                        return $row->order ? $row->order->order_num : '';
                    }, 
                ],
                'gates' => [
                    'view' => false,
                    'edit' => false,
                    'delete' => false
                ],
                'crudRoutePart' => 'coupon-usages'
            ];

            $handler = new DataTableHandler(new CouponUsage(), $config);
            return $handler->handle($request);
        }

        return view('admin.couponUsages.index');
    }
}
