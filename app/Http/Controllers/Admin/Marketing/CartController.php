<?php

namespace App\Http\Controllers\Admin\Marketing;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use Illuminate\Support\Facades\Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Utils\DataTableHandler;

class CartController extends Controller
{
    public function index(Request $request)
    {
        abort_if(Gate::denies('cart_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $config = [
                'relations' => ['user', 'product', 'store'],
                'columns' => [ 
                    'product_name' => function ($row) {
                        return $row->product ? $row->product->name : '';
                    },
                    'store_store_name' => function ($row) {
                        return $row->store ? $row->store->store_name : '';
                    }, 
                ],
                'gates' => [
                    'view' => 'cart_show',
                    'edit' => 'cart_edit',
                    'delete' => 'cart_delete'
                ],
                'crudRoutePart' => 'carts'
            ];

            $handler = new DataTableHandler(new Cart(), $config);
            return $handler->handle($request);
        }

        return view('admin.marketing.carts.index');
    }

}
