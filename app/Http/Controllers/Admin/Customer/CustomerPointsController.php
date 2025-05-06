<?php

namespace App\Http\Controllers\Admin\Customer;

use App\Http\Controllers\Controller;
use App\Models\CustomerPoint;
use App\Utils\DataTableHandler;
use Illuminate\Support\Facades\Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CustomerPointsController extends Controller
{
    public function index(Request $request)
    {
        abort_if(Gate::denies('customer_point_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $config = [
                'relations' => ['user', 'order', 'order_detail', 'product'],
                'columns' => [ 
                    'user_name' => function ($row) {
                        return $row->user ? $row->user->name : '';
                    }, 
                    'order_order_num' => function ($row) {
                        return $row->order ? $row->order->order_num : '';
                    },
                    'product_name' => function ($row) {
                        return $row->product ? $row->product->name : '';
                    }, 
                    'refunded' => [
                        'type' => 'checkbox',
                        'options' => [
                            'disabled' => true
                        ]
                    ],
                    'converted' => [
                        'type' => 'checkbox',
                        'options' => [
                            'disabled' => true
                        ]
                    ],
                ],
                'gates' => [
                    'view' => 'customer_point_show',
                    'edit' => false,
                    'delete' => false
                ],
                'crudRoutePart' => 'customer-points'
            ];

            $handler = new DataTableHandler(new CustomerPoint(), $config);
            return $handler->handle($request);
        }

        return view('admin.customer.customerPoints.index');
    } 

    public function show(CustomerPoint $customerPoint)
    {
        abort_if(Gate::denies('customer_point_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $customerPoint->load('user', 'order', 'order_detail', 'product');

        return view('admin.customer.customerPoints.show', compact('customerPoint'));
    } 
}
