<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\MassDestroyStoreReviewRequest;
use App\Http\Requests\Admin\StoreStoreReviewRequest;
use App\Http\Requests\Admin\UpdateStoreReviewRequest;
use App\Models\Store;
use App\Models\StoreReview;
use App\Models\User;
use Illuminate\Support\Facades\Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class StoreReviewsController extends Controller
{
    public function index(Request $request)
    {
        abort_if(Gate::denies('store_review_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = StoreReview::with(['store', 'user'])->select(sprintf('%s.*', (new StoreReview)->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate      = 'store_review_show';
                $editGate      = 'store_review_edit';
                $deleteGate    = 'store_review_delete';
                $crudRoutePart = 'store-reviews';

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
            $table->addColumn('store_store_name', function ($row) {
                return $row->store ? $row->store->store_name : '';
            });

            $table->addColumn('user_name', function ($row) {
                return $row->user ? $row->user->name : '';
            });

            $table->editColumn('rate', function ($row) {
                return $row->rate ? $row->rate : '';
            });
            $table->editColumn('review', function ($row) {
                return $row->review ? $row->review : '';
            });

            $table->rawColumns(['actions', 'placeholder', 'store', 'user']);

            return $table->make(true);
        }

        return view('admin.storeReviews.index');
    }

    public function create()
    {
        abort_if(Gate::denies('store_review_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $stores = Store::pluck('store_name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $users = User::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.storeReviews.create', compact('stores', 'users'));
    }

    public function store(StoreStoreReviewRequest $request)
    {
        $storeReview = StoreReview::create($request->all());

        return redirect()->route('admin.store-reviews.index');
    }

    public function edit(StoreReview $storeReview)
    {
        abort_if(Gate::denies('store_review_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $stores = Store::pluck('store_name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $users = User::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $storeReview->load('store', 'user');

        return view('admin.storeReviews.edit', compact('storeReview', 'stores', 'users'));
    }

    public function update(UpdateStoreReviewRequest $request, StoreReview $storeReview)
    {
        $storeReview->update($request->all());

        return redirect()->route('admin.store-reviews.index');
    }

    public function show(StoreReview $storeReview)
    {
        abort_if(Gate::denies('store_review_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $storeReview->load('store', 'user');

        return view('admin.storeReviews.show', compact('storeReview'));
    }

    public function destroy(StoreReview $storeReview)
    {
        abort_if(Gate::denies('store_review_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $storeReview->delete();

        return back();
    }

    public function massDestroy(MassDestroyStoreReviewRequest $request)
    {
        $storeReviews = StoreReview::find(request('ids'));

        foreach ($storeReviews as $storeReview) {
            $storeReview->delete();
        }

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
