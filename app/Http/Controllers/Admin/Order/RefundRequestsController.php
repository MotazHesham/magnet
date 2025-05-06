<?php

namespace App\Http\Controllers\Admin\Order;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\Admin\MassDestroyRefundRequestRequest;
use App\Http\Requests\Admin\StoreRefundRequestRequest;
use App\Http\Requests\Admin\UpdateRefundRequestRequest;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\RefundRequest;
use App\Models\SpecialOrder;
use App\Models\Store;
use App\Models\User;
use App\Utils\DataTableHandler;
use App\Utils\MediaHandler;
use Illuminate\Support\Facades\Gate;
use Illuminate\Http\Request;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Symfony\Component\HttpFoundation\Response;

class RefundRequestsController extends Controller
{
    use MediaUploadingTrait;

    public function __construct(
        protected MediaHandler $mediaHandler
    ) {}

    public function index(Request $request)
    {
        abort_if(Gate::denies('refund_request_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $config = [
                'relations' => ['user', 'special_order', 'order', 'order_detail', 'store'],
                'columns' => [ 
                    'user_name' => function ($row) {
                        return $row->user ? $row->user->name : '';
                    },
                    'store_store_name' => function ($row) {
                        return $row->store ? $row->store->store_name : '';
                    }, 
                    'store_approval' => [
                        'type' => 'checkbox',
                        'options' => [
                            'model' => RefundRequest::class,
                        ]
                    ],
                    'admin_approval' => [
                        'type' => 'checkbox',
                        'options' => [
                            'model' => RefundRequest::class,
                        ]
                    ],
                    'refund_status' => function ($row) {
                        return $row->refund_status ? RefundRequest::REFUND_STATUS_SELECT[$row->refund_status] : '';
                    }
                ],
                'gates' => [
                    'view' => 'refund_request_show',
                    'edit' => 'refund_request_edit',
                    'delete' => 'refund_request_delete'
                ],
                'crudRoutePart' => 'refund-requests',
                'rawColumns' => ['store_approval', 'admin_approval']
            ];

            $handler = new DataTableHandler(new RefundRequest(), $config);
            return $handler->handle($request);
        }

        return view('admin.order.refundRequests.index');
    }

    public function create()
    {
        abort_if(Gate::denies('refund_request_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $users = User::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $special_orders = SpecialOrder::pluck('order_num', 'id')->prepend(trans('global.pleaseSelect'), '');

        $orders = Order::pluck('order_num', 'id')->prepend(trans('global.pleaseSelect'), '');

        $order_details = OrderDetail::pluck('note', 'id')->prepend(trans('global.pleaseSelect'), '');

        $stores = Store::pluck('store_name', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.order.refundRequests.create', compact('order_details', 'orders', 'special_orders', 'stores', 'users'));
    }

    public function store(StoreRefundRequestRequest $request)
    {
        $refundRequest = RefundRequest::create($request->all());

        if ($request->input('invoice_photo', false)) {
            $this->mediaHandler->handleMediaUpload($refundRequest, 'invoice_photo', $request->input('invoice_photo'));
        }

        if ($request->input('product_photo', false)) {
            $this->mediaHandler->handleMediaUpload($refundRequest, 'product_photo', $request->input('product_photo'));
        }

        if ($media = $request->input('ck-media', false)) {
            $this->mediaHandler->updateMediaModelIds($refundRequest, $media);
        }

        return redirect()->route('admin.refund-requests.index');
    }

    public function edit(RefundRequest $refundRequest)
    {
        abort_if(Gate::denies('refund_request_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $users = User::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $special_orders = SpecialOrder::pluck('order_num', 'id')->prepend(trans('global.pleaseSelect'), '');

        $orders = Order::pluck('order_num', 'id')->prepend(trans('global.pleaseSelect'), '');

        $order_details = OrderDetail::pluck('note', 'id')->prepend(trans('global.pleaseSelect'), '');

        $stores = Store::pluck('store_name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $refundRequest->load('user', 'special_order', 'order', 'order_detail', 'store');

        return view('admin.order.refundRequests.edit', compact('order_details', 'orders', 'refundRequest', 'special_orders', 'stores', 'users'));
    }

    public function update(UpdateRefundRequestRequest $request, RefundRequest $refundRequest)
    {
        $refundRequest->update($request->all());

        if ($request->input('invoice_photo', false)) {
            $this->mediaHandler->handleMediaUpload($refundRequest, 'invoice_photo', $request->input('invoice_photo'));
        }

        if ($request->input('product_photo', false)) {
            $this->mediaHandler->handleMediaUpload($refundRequest, 'product_photo', $request->input('product_photo'));
        }

        return redirect()->route('admin.refund-requests.index');
    }

    public function show(RefundRequest $refundRequest)
    {
        abort_if(Gate::denies('refund_request_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $refundRequest->load('user', 'special_order', 'order', 'order_detail', 'store');

        return view('admin.order.refundRequests.show', compact('refundRequest'));
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

        $model = new RefundRequest();
        $result = $this->mediaHandler->handleCKEditorImages($model, 'ck-media', $request->all());

        return response()->json($result, Response::HTTP_CREATED);
    }
}
