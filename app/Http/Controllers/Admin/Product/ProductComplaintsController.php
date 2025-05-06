<?php

namespace App\Http\Controllers\Admin\Product;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\MassDestroyProductComplaintRequest;
use App\Http\Requests\Admin\StoreProductComplaintRequest;
use App\Http\Requests\Admin\UpdateProductComplaintRequest;
use App\Models\Product;
use App\Models\ProductComplaint;
use App\Models\User;
use App\Utils\DataTableHandler;
use Illuminate\Support\Facades\Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ProductComplaintsController extends Controller
{
    public function index(Request $request)
    {
        abort_if(Gate::denies('product_complaint_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

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
                    'reason' => function ($row) {
                        return $row->reason ? $row->reason : '';
                    },
                ],
                'gates' => [
                    'view' => false,
                    'edit' => false,
                    'delete' => 'product_complaint_delete'
                ],
                'crudRoutePart' => 'product-complaints'
            ];

            $handler = new DataTableHandler(new ProductComplaint(), $config);
            return $handler->handle($request);
        }

        return view('admin.product.productComplaints.index');
    }

    public function destroy(ProductComplaint $productComplaint)
    {
        abort_if(Gate::denies('product_complaint_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $productComplaint->delete();

        return back();
    }

    public function massDestroy(MassDestroyProductComplaintRequest $request)
    {
        ProductComplaint::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
