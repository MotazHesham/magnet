<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\MassDestroyRefundRequestRequest;
use App\Http\Requests\StoreRefundRequestRequest;
use App\Http\Requests\UpdateRefundRequestRequest;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\RefundRequest;
use App\Models\SpecialOrder;
use App\Models\Store;
use App\Models\User;
use Gate;
use Illuminate\Http\Request;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class RefundRequestsController extends Controller
{
    use MediaUploadingTrait;

    public function index(Request $request)
    {
        abort_if(Gate::denies('refund_request_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = RefundRequest::with(['user', 'special_order', 'order', 'order_detail', 'store'])->select(sprintf('%s.*', (new RefundRequest)->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate      = 'refund_request_show';
                $editGate      = 'refund_request_edit';
                $deleteGate    = 'refund_request_delete';
                $crudRoutePart = 'refund-requests';

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
            $table->addColumn('user_name', function ($row) {
                return $row->user ? $row->user->name : '';
            });

            $table->addColumn('store_store_name', function ($row) {
                return $row->store ? $row->store->store_name : '';
            });

            $table->editColumn('reason', function ($row) {
                return $row->reason ? $row->reason : '';
            });
            $table->editColumn('refund_amount', function ($row) {
                return $row->refund_amount ? $row->refund_amount : '';
            });
            $table->editColumn('store_approval', function ($row) {
                return '<input type="checkbox" disabled ' . ($row->store_approval ? 'checked' : null) . '>';
            });
            $table->editColumn('admin_approval', function ($row) {
                return '<input type="checkbox" disabled ' . ($row->admin_approval ? 'checked' : null) . '>';
            });
            $table->editColumn('reject_reason', function ($row) {
                return $row->reject_reason ? $row->reject_reason : '';
            });
            $table->editColumn('invoice_photo', function ($row) {
                if ($photo = $row->invoice_photo) {
                    return sprintf(
                        '<a href="%s" target="_blank"><img src="%s" width="50px" height="50px"></a>',
                        $photo->url,
                        $photo->thumbnail
                    );
                }

                return '';
            });
            $table->editColumn('product_photo', function ($row) {
                if ($photo = $row->product_photo) {
                    return sprintf(
                        '<a href="%s" target="_blank"><img src="%s" width="50px" height="50px"></a>',
                        $photo->url,
                        $photo->thumbnail
                    );
                }

                return '';
            });
            $table->editColumn('refund_status', function ($row) {
                return $row->refund_status ? RefundRequest::REFUND_STATUS_SELECT[$row->refund_status] : '';
            });

            $table->rawColumns(['actions', 'placeholder', 'user', 'store', 'store_approval', 'admin_approval', 'invoice_photo', 'product_photo']);

            return $table->make(true);
        }

        return view('admin.refundRequests.index');
    }

    public function create()
    {
        abort_if(Gate::denies('refund_request_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $users = User::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $special_orders = SpecialOrder::pluck('order_num', 'id')->prepend(trans('global.pleaseSelect'), '');

        $orders = Order::pluck('order_num', 'id')->prepend(trans('global.pleaseSelect'), '');

        $order_details = OrderDetail::pluck('variant', 'id')->prepend(trans('global.pleaseSelect'), '');

        $stores = Store::pluck('store_name', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.refundRequests.create', compact('order_details', 'orders', 'special_orders', 'stores', 'users'));
    }

    public function store(StoreRefundRequestRequest $request)
    {
        $refundRequest = RefundRequest::create($request->all());

        if ($request->input('invoice_photo', false)) {
            $refundRequest->addMedia(storage_path('tmp/uploads/' . basename($request->input('invoice_photo'))))->toMediaCollection('invoice_photo');
        }

        if ($request->input('product_photo', false)) {
            $refundRequest->addMedia(storage_path('tmp/uploads/' . basename($request->input('product_photo'))))->toMediaCollection('product_photo');
        }

        if ($media = $request->input('ck-media', false)) {
            Media::whereIn('id', $media)->update(['model_id' => $refundRequest->id]);
        }

        return redirect()->route('admin.refund-requests.index');
    }

    public function edit(RefundRequest $refundRequest)
    {
        abort_if(Gate::denies('refund_request_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $users = User::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $special_orders = SpecialOrder::pluck('order_num', 'id')->prepend(trans('global.pleaseSelect'), '');

        $orders = Order::pluck('order_num', 'id')->prepend(trans('global.pleaseSelect'), '');

        $order_details = OrderDetail::pluck('variant', 'id')->prepend(trans('global.pleaseSelect'), '');

        $stores = Store::pluck('store_name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $refundRequest->load('user', 'special_order', 'order', 'order_detail', 'store');

        return view('admin.refundRequests.edit', compact('order_details', 'orders', 'refundRequest', 'special_orders', 'stores', 'users'));
    }

    public function update(UpdateRefundRequestRequest $request, RefundRequest $refundRequest)
    {
        $refundRequest->update($request->all());

        if ($request->input('invoice_photo', false)) {
            if (! $refundRequest->invoice_photo || $request->input('invoice_photo') !== $refundRequest->invoice_photo->file_name) {
                if ($refundRequest->invoice_photo) {
                    $refundRequest->invoice_photo->delete();
                }
                $refundRequest->addMedia(storage_path('tmp/uploads/' . basename($request->input('invoice_photo'))))->toMediaCollection('invoice_photo');
            }
        } elseif ($refundRequest->invoice_photo) {
            $refundRequest->invoice_photo->delete();
        }

        if ($request->input('product_photo', false)) {
            if (! $refundRequest->product_photo || $request->input('product_photo') !== $refundRequest->product_photo->file_name) {
                if ($refundRequest->product_photo) {
                    $refundRequest->product_photo->delete();
                }
                $refundRequest->addMedia(storage_path('tmp/uploads/' . basename($request->input('product_photo'))))->toMediaCollection('product_photo');
            }
        } elseif ($refundRequest->product_photo) {
            $refundRequest->product_photo->delete();
        }

        return redirect()->route('admin.refund-requests.index');
    }

    public function show(RefundRequest $refundRequest)
    {
        abort_if(Gate::denies('refund_request_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $refundRequest->load('user', 'special_order', 'order', 'order_detail', 'store');

        return view('admin.refundRequests.show', compact('refundRequest'));
    }

    public function destroy(RefundRequest $refundRequest)
    {
        abort_if(Gate::denies('refund_request_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $refundRequest->delete();

        return back();
    }

    public function massDestroy(MassDestroyRefundRequestRequest $request)
    {
        $refundRequests = RefundRequest::find(request('ids'));

        foreach ($refundRequests as $refundRequest) {
            $refundRequest->delete();
        }

        return response(null, Response::HTTP_NO_CONTENT);
    }

    public function storeCKEditorImages(Request $request)
    {
        abort_if(Gate::denies('refund_request_create') && Gate::denies('refund_request_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $model         = new RefundRequest();
        $model->id     = $request->input('crud_id', 0);
        $model->exists = true;
        $media         = $model->addMediaFromRequest('upload')->toMediaCollection('ck-media');

        return response()->json(['id' => $media->id, 'url' => $media->getUrl()], Response::HTTP_CREATED);
    }
}
