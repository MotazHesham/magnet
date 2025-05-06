<?php

namespace App\Http\Controllers\Admin\Order;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\Admin\MassDestroySpecialOrderRequest;
use App\Http\Requests\Admin\StoreSpecialOrderRequest;
use App\Http\Requests\Admin\UpdateSpecialOrderRequest;
use App\Models\ProductCategory;
use App\Models\SpecialOrder;
use App\Models\Store;
use App\Models\User;
use App\Utils\DataTableHandler;
use App\Utils\MediaHandler;
use Illuminate\Support\Facades\Gate;
use Illuminate\Http\Request;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Symfony\Component\HttpFoundation\Response;

class SpecialOrdersController extends Controller
{
    use MediaUploadingTrait;

    public function __construct(
        protected MediaHandler $mediaHandler
    ) {}

    public function index(Request $request)
    {
        abort_if(Gate::denies('special_order_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $config = [
                'relations' => ['user', 'store', 'category'],
                'columns' => [ 
                    'user_name' => function ($row) {
                        return $row->user ? $row->user->name : '';
                    },
                    'store_store_name' => function ($row) {
                        return $row->store ? $row->store->store_name : '';
                    },  
                    'category_name' => function ($row) {
                        return $row->category ? $row->category->name : '';
                    }, 
                    'delivery_status' => function ($row) {
                        return $row->delivery_status ? SpecialOrder::DELIVERY_STATUS_SELECT[$row->delivery_status] : '';
                    },
                    'offer_price_status' => function ($row) {
                        return $row->offer_price_status ? SpecialOrder::OFFER_PRICE_STATUS_SELECT[$row->offer_price_status] : '';
                    },
                    'payment_method' => function ($row) {
                        return $row->payment_method ? SpecialOrder::PAYMENT_METHOD_SELECT[$row->payment_method] : '';
                    },
                    'payment_status' => function ($row) {
                        return $row->payment_status ? SpecialOrder::PAYMENT_STATUS_SELECT[$row->payment_status] : '';
                    }, 
                ],
                'gates' => [
                    'view' => 'special_order_show',
                    'edit' => 'special_order_edit',
                    'delete' => 'special_order_delete'
                ],
                'crudRoutePart' => 'special-orders',
                'rawColumns' => ['files']
            ];

            $handler = new DataTableHandler(new SpecialOrder(), $config);
            return $handler->handle($request);
        }

        return view('admin.order.specialOrders.index');
    }

    public function create()
    {
        abort_if(Gate::denies('special_order_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $users = User::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $stores = Store::pluck('store_name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $categories = ProductCategory::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.order.specialOrders.create', compact('categories', 'stores', 'users'));
    }

    public function store(StoreSpecialOrderRequest $request)
    {
        $specialOrder = SpecialOrder::create($request->all());

        if ($request->input('files', false)) {
            $this->mediaHandler->handleMediaUpload($specialOrder, 'files', $request->input('files'), ['single' => false]);
        }

        if ($media = $request->input('ck-media', false)) {
            $this->mediaHandler->updateMediaModelIds($specialOrder, $media);
        }

        return redirect()->route('admin.special-orders.index');
    }

    public function edit(SpecialOrder $specialOrder)
    {
        abort_if(Gate::denies('special_order_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $users = User::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $stores = Store::pluck('store_name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $categories = ProductCategory::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $specialOrder->load('user', 'store', 'category');

        return view('admin.order.specialOrders.edit', compact('categories', 'specialOrder', 'stores', 'users'));
    }

    public function update(UpdateSpecialOrderRequest $request, SpecialOrder $specialOrder)
    {
        $specialOrder->update($request->all());

        if ($request->input('files', false)) {
            $this->mediaHandler->handleMediaUpload($specialOrder, 'files', $request->input('files'), ['single' => false]);
        }

        return redirect()->route('admin.special-orders.index');
    }

    public function show(SpecialOrder $specialOrder)
    {
        abort_if(Gate::denies('special_order_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $specialOrder->load('user', 'store', 'category');

        return view('admin.order.specialOrders.show', compact('specialOrder'));
    }

    public function destroy(SpecialOrder $specialOrder)
    {
        abort_if(Gate::denies('special_order_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $specialOrder->delete();

        return back();
    }

    public function massDestroy(MassDestroySpecialOrderRequest $request)
    {
        $specialOrders = SpecialOrder::find(request('ids'));

        foreach ($specialOrders as $specialOrder) {
            $specialOrder->delete();
        }

        return response(null, Response::HTTP_NO_CONTENT);
    }

    public function storeCKEditorImages(Request $request)
    {
        abort_if(Gate::denies('special_order_create') && Gate::denies('special_order_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $model = new SpecialOrder();
        $result = $this->mediaHandler->handleCKEditorImages($model, 'ck-media', $request->all());

        return response()->json($result, Response::HTTP_CREATED);
    }
}
