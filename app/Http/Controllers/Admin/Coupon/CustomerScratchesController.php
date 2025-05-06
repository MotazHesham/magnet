<?php

namespace App\Http\Controllers\Admin\Coupon;

use App\Http\Controllers\Controller; 
use App\Models\CustomerScratch; 
use Illuminate\Support\Facades\Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Utils\DataTableHandler;

class CustomerScratchesController extends Controller
{
    public function index(Request $request)
    {
        abort_if(Gate::denies('customer_scratch_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $config = [
                'relations' => ['user', 'scratch'],
                'columns' => [ 
                    'user_name' => function ($row) {
                        return $row->user ? $row->user->name : '';
                    },
                    'scratch_name' => function ($row) {
                        return $row->scratch ? $row->scratch->name : '';
                    },
                    'used' => [
                        'type' => 'checkbox',
                        'options' => [
                            'disabled' => true
                        ]
                    ]
                ],
                'gates' => [
                    'view' => false,
                    'edit' => false,
                    'delete' => false
                ],
                'crudRoutePart' => 'customer-scratches',
                'rawColumns' => ['used']
            ];

            $handler = new DataTableHandler(new CustomerScratch(), $config);
            return $handler->handle($request);
        }

        return view('admin.customerScratches.index');
    } 
}
