<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\MassDestroyProductReviewRequest; 
use App\Models\ProductReview; 
use Illuminate\Support\Facades\Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class ProductReviewsController extends Controller
{
    public function index(Request $request)
    {
        abort_if(Gate::denies('product_review_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = ProductReview::with(['product', 'user'])->select(sprintf('%s.*', (new ProductReview)->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate      = false;
                $editGate      = false;
                $deleteGate    = 'product_review_delete';
                $crudRoutePart = 'product-reviews';

                return view('partials.datatablesActions', compact(
                    'viewGate',
                    'editGate',
                    'deleteGate',
                    'crudRoutePart',
                    'row'
                ));
            });

            $table->editColumn('id', function ($row) {
                return $row->id ? $row->id : '';
            });
            $table->editColumn('rate', function ($row) {
                return $row->rate ? $row->rate : '';
            });
            $table->editColumn('review', function ($row) {
                return $row->review ? $row->review : '';
            });
            $table->addColumn('product_name', function ($row) {
                return $row->product ? $row->product->name : '';
            });

            $table->addColumn('user_name', function ($row) {
                return $row->user ? $row->user->name : '';
            });

            $table->rawColumns(['actions', 'placeholder', 'product', 'user']);

            return $table->make(true);
        }

        return view('admin.productReviews.index');
    }

    public function destroy(ProductReview $productReview)
    {
        abort_if(Gate::denies('product_review_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $productReview->delete();

        return back();
    }

    public function massDestroy(MassDestroyProductReviewRequest $request)
    {
        $productReviews = ProductReview::find(request('ids'));

        foreach ($productReviews as $productReview) {
            $productReview->delete();
        }

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
