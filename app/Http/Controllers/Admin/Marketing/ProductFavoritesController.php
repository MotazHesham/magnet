<?php

namespace App\Http\Controllers\Admin\Marketing;

use App\Http\Controllers\Controller;
use App\Models\ProductFavorite;
use App\Utils\DataTableHandler;
use Illuminate\Support\Facades\Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ProductFavoritesController extends Controller
{
    public function index(Request $request)
    {
        abort_if(Gate::denies('product_favorite_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $config = [
                'relations' => ['product', 'user'],
                'columns' => [ 
                    'product_name' => function ($row) {
                        return $row->product ? $row->product->name : '';
                    },
                    'user_name' => function ($row) {
                        return $row->user ? $row->user->name : '';
                    }
                ],
                'gates' => [
                    'view' => false,
                    'edit' => false,
                    'delete' => false
                ],
                'crudRoutePart' => 'product-favorites',
                'rawColumns' => ['product', 'user']
            ];

            $handler = new DataTableHandler(new ProductFavorite(), $config);
            return $handler->handle($request);
        }

        return view('admin.marketing.productFavorites.index');
    }
}
