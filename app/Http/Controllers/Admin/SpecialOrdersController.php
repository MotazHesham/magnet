<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\Admin\MassDestroySpecialOrderRequest;
use App\Http\Requests\Admin\StoreSpecialOrderRequest;
use App\Http\Requests\Admin\UpdateSpecialOrderRequest;
use App\Models\ProductCategory;
use App\Models\SpecialOrder;
use App\Models\Store;
use App\Models\User;
use Illuminate\Support\Facades\Gate;
use Illuminate\Http\Request;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class SpecialOrdersController extends Controller
{
    use MediaUploadingTrait;

    public function index(Request $request)
    {
        abort_if(Gate::denies('special_order_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = SpecialOrder::with(['user', 'store', 'category'])->select(sprintf('%s.*', (new SpecialOrder)->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate      = 'special_order_show';
                $editGate      = 'special_order_edit';
                $deleteGate    = 'special_order_delete';
                $crudRoutePart = 'special-orders';

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
            $table->editColumn('order_num', function ($row) {
                return $row->order_num ? $row->order_num : '';
            });
            $table->addColumn('user_name', function ($row) {
                return $row->user ? $row->user->name : '';
            });

            $table->addColumn('store_store_name', function ($row) {
                return $row->store ? $row->store->store_name : '';
            });

            $table->editColumn('files', function ($row) {
                if (! $row->files) {
                    return '';
                }
                $links = [];
                foreach ($row->files as $media) {
                    $links[] = '<a href="' . $media->getUrl() . '" target="_blank">' . trans('global.downloadFile') . '</a>';
                }

                return implode(', ', $links);
            });
            $table->editColumn('color', function ($row) {
                return $row->color ? $row->color : '';
            });
            $table->addColumn('category_name', function ($row) {
                return $row->category ? $row->category->name : '';
            });

            $table->editColumn('description', function ($row) {
                return $row->description ? $row->description : '';
            });
            $table->editColumn('delivery_status', function ($row) {
                return $row->delivery_status ? SpecialOrder::DELIVERY_STATUS_SELECT[$row->delivery_status] : '';
            });
            $table->editColumn('offer_price_status', function ($row) {
                return $row->offer_price_status ? SpecialOrder::OFFER_PRICE_STATUS_SELECT[$row->offer_price_status] : '';
            });
            $table->editColumn('payment_method', function ($row) {
                return $row->payment_method ? SpecialOrder::PAYMENT_METHOD_SELECT[$row->payment_method] : '';
            });
            $table->editColumn('payment_status', function ($row) {
                return $row->payment_status ? SpecialOrder::PAYMENT_STATUS_SELECT[$row->payment_status] : '';
            });
            $table->editColumn('shipping_cost', function ($row) {
                return $row->shipping_cost ? $row->shipping_cost : '';
            });
            $table->editColumn('total', function ($row) {
                return $row->total ? $row->total : '';
            });

            $table->rawColumns(['actions', 'placeholder', 'user', 'store', 'files', 'category']);

            return $table->make(true);
        }

        return view('admin.specialOrders.index');
    }

    public function create()
    {
        abort_if(Gate::denies('special_order_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $users = User::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $stores = Store::pluck('store_name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $categories = ProductCategory::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.specialOrders.create', compact('categories', 'stores', 'users'));
    }

    public function store(StoreSpecialOrderRequest $request)
    {
        $specialOrder = SpecialOrder::create($request->all());

        foreach ($request->input('files', []) as $file) {
            $specialOrder->addMedia(storage_path('tmp/uploads/' . basename($file)))->toMediaCollection('files');
        }

        if ($media = $request->input('ck-media', false)) {
            Media::whereIn('id', $media)->update(['model_id' => $specialOrder->id]);
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

        return view('admin.specialOrders.edit', compact('categories', 'specialOrder', 'stores', 'users'));
    }

    public function update(UpdateSpecialOrderRequest $request, SpecialOrder $specialOrder)
    {
        $specialOrder->update($request->all());

        if (count($specialOrder->files) > 0) {
            foreach ($specialOrder->files as $media) {
                if (! in_array($media->file_name, $request->input('files', []))) {
                    $media->delete();
                }
            }
        }
        $media = $specialOrder->files->pluck('file_name')->toArray();
        foreach ($request->input('files', []) as $file) {
            if (count($media) === 0 || ! in_array($file, $media)) {
                $specialOrder->addMedia(storage_path('tmp/uploads/' . basename($file)))->toMediaCollection('files');
            }
        }

        return redirect()->route('admin.special-orders.index');
    }

    public function show(SpecialOrder $specialOrder)
    {
        abort_if(Gate::denies('special_order_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $specialOrder->load('user', 'store', 'category');

        return view('admin.specialOrders.show', compact('specialOrder'));
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

        $model         = new SpecialOrder();
        $model->id     = $request->input('crud_id', 0);
        $model->exists = true;
        $media         = $model->addMediaFromRequest('upload')->toMediaCollection('ck-media');

        return response()->json(['id' => $media->id, 'url' => $media->getUrl()], Response::HTTP_CREATED);
    }
}
