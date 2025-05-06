<?php

namespace App\Http\Controllers\Admin\Product;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\MassDestroyProductReviewRequest; 
use App\Models\ProductReview;
use App\Utils\DataTableHandler;
use Illuminate\Support\Facades\Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ProductReviewsController extends Controller
{
    public function index(Request $request)
    {
        abort_if(Gate::denies('product_review_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $config = [
                'relations' => ['product', 'user'],
                'columns' => [ 
                    'product_name' => function ($row) {
                        return $row->product ? $row->product->name : '';
                    },
                    'user_name' => function ($row) {
                        return $row->user ? $row->user->name : '';
                    },
                ],
                'gates' => [
                    'view' => false,
                    'edit' => false,
                    'delete' => 'product_review_delete'
                ],
                'crudRoutePart' => 'product-reviews'
            ];

            $handler = new DataTableHandler(new ProductReview(), $config);
            return $handler->handle($request);
        }

        return view('admin.product.productReviews.index');
    }

    public function destroy(ProductReview $productReview)
    {
        abort_if(Gate::denies('product_review_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $productReview->delete();

        return back();
    }

    public function massDestroy(MassDestroyProductReviewRequest $request)
    {
        ProductReview::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
