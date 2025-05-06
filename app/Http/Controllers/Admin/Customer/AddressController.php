<?php

namespace App\Http\Controllers\Admin\Customer;

use App\Http\Controllers\Controller;
use App\Models\Address;
use App\Utils\DataTableHandler;
use Illuminate\Support\Facades\Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AddressController extends Controller
{
    public function index(Request $request)
    {
        abort_if(Gate::denies('address_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $config = [
                'relations' => ['user', 'region', 'city', 'district'],
                'columns' => [ 
                    'user_name' => function ($row) {
                        return $row->user ? $row->user->name : '';
                    }, 
                    'region_name' => function ($row) {
                        return $row->region ? $row->region->name : '';
                    },
                    'city_name' => function ($row) {
                        return $row->city ? $row->city->name : '';
                    },
                    'district_name' => function ($row) {
                        return $row->district ? $row->district->name : '';
                    }, 
                    'is_default' => [
                        'type' => 'checkbox',
                        'options' => [
                            'disabled' => true
                        ]
                    ],
                ],
                'gates' => [
                    'view' => 'address_show',
                    'edit' => false,
                    'delete' => false
                ],
                'crudRoutePart' => 'addresses'
            ];

            $handler = new DataTableHandler(new Address(), $config);
            return $handler->handle($request);
        }

        return view('admin.customer.addresses.index');
    } 

    public function show(Address $address)
    {
        abort_if(Gate::denies('address_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $address->load('user', 'region', 'city', 'district');

        return view('admin.customer.addresses.show', compact('address'));
    } 
}
