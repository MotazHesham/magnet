<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\MassDestroyProductComplaintRequest;
use App\Http\Requests\Admin\StoreProductComplaintRequest;
use App\Http\Requests\Admin\UpdateProductComplaintRequest;
use App\Models\Product;
use App\Models\ProductComplaint;
use App\Models\User;
use Illuminate\Support\Facades\Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class ProductComplaintsController extends Controller
{
    public function index(Request $request)
    {
        abort_if(Gate::denies('product_complaint_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = ProductComplaint::with(['product', 'user'])->select(sprintf('%s.*', (new ProductComplaint)->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate      = false;
                $editGate      = false;
                $deleteGate    = 'product_complaint_delete';
                $crudRoutePart = 'product-complaints';

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
            $table->addColumn('product_name', function ($row) {
                return $row->product ? $row->product->name : '';
            });

            $table->addColumn('user_name', function ($row) {
                return $row->user ? $row->user->name : '';
            });

            $table->editColumn('reason', function ($row) {
                return $row->reason ? $row->reason : '';
            });

            $table->rawColumns(['actions', 'placeholder', 'product', 'user']);

            return $table->make(true);
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
        $productComplaints = ProductComplaint::find(request('ids'));

        foreach ($productComplaints as $productComplaint) {
            $productComplaint->delete();
        }

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
