<?php

namespace App\Http\Controllers\Admin\Marketing;

use App\Http\Controllers\Controller; 
use App\Models\ProductStockRemember; 
use Illuminate\Support\Facades\Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Utils\DataTableHandler;

class ProductStockRememberController extends Controller
{
    public function index(Request $request)
    {
        abort_if(Gate::denies('product_stock_remember_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $config = [
                'relations' => ['user', 'product'],
                'columns' => [ 
                    'user_name' => function ($row) {
                        return $row->user ? $row->user->name : '';
                    },
                    'product_name' => function ($row) {
                        return $row->product ? $row->product->name : '';
                    }
                ],
                'gates' => [
                    'view' => false,
                    'edit' => false,
                    'delete' => false
                ],
                'crudRoutePart' => 'product-stock-remembers'
            ];

            $handler = new DataTableHandler(new ProductStockRemember(), $config);
            return $handler->handle($request);
        }

        return view('admin.marketing.productStockRemembers.index');
    } 
}
