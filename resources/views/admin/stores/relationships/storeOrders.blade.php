<div class="card"> 

    <div class="card-body">
        <div class="table-responsive">
            <table class=" table table-bordered table-striped table-hover datatable datatable-storeOrders">
                <thead>
                    <tr>
                        <th width="10">

                        </th>
                        <th>
                            {{ trans('cruds.order.fields.id') }}
                        </th>
                        <th>
                            {{ trans('cruds.order.fields.order_num') }}
                        </th>
                        <th>
                            {{ trans('cruds.order.fields.user') }}
                        </th>
                        <th>
                            {{ trans('cruds.order.fields.delivery_status') }}
                        </th>
                        <th>
                            {{ trans('cruds.order.fields.payment_method') }}
                        </th>
                        <th>
                            {{ trans('cruds.order.fields.payment_status') }}
                        </th>
                        <th>
                            {{ trans('cruds.order.fields.shipping_address') }}
                        </th>
                        <th>
                            {{ trans('cruds.order.fields.shipping_type') }}
                        </th>
                        <th>
                            {{ trans('cruds.order.fields.coupon_discount') }}
                        </th>
                        <th>
                            {{ trans('cruds.order.fields.shipping_cost') }}
                        </th>
                        <th>
                            {{ trans('cruds.order.fields.total') }}
                        </th>
                        <th>
                            &nbsp;
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($orders as $key => $order)
                        <tr data-entry-id="{{ $order->id }}">
                            <td>

                            </td>
                            <td>
                                {{ $order->id ?? '' }}
                            </td>
                            <td>
                                {{ $order->order_num ?? '' }}
                            </td>
                            <td>
                                {{ $order->user->name ?? '' }}
                            </td>
                            <td>
                                {{ App\Models\Order::DELIVERY_STATUS_SELECT[$order->delivery_status] ?? '' }}
                            </td>
                            <td>
                                {{ App\Models\Order::PAYMENT_METHOD_SELECT[$order->payment_method] ?? '' }}
                            </td>
                            <td>
                                {{ App\Models\Order::PAYMENT_STATUS_SELECT[$order->payment_status] ?? '' }}
                            </td>
                            <td>
                                {{ $order->shipping_address ?? '' }}
                            </td>
                            <td>
                                {{ App\Models\Order::SHIPPING_TYPE_SELECT[$order->shipping_type] ?? '' }}
                            </td>
                            <td>
                                {{ $order->coupon_discount ?? '' }}
                            </td>
                            <td>
                                {{ $order->shipping_cost ?? '' }}
                            </td>
                            <td>
                                {{ $order->total ?? '' }}
                            </td>
                            <td>
                                @can('order_show')
                                    <a class="btn btn-xs btn-primary" href="{{ route('admin.orders.show', $order->id) }}">
                                        {{ trans('global.view') }}
                                    </a>
                                @endcan

                            </td>

                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

@section('scripts')
    @parent
    <script>
        $(function() {
            let dtButtons = $.extend(true, [], $.fn.dataTable.defaults.buttons) 

            $.extend(true, $.fn.dataTable.defaults, {
                orderCellsTop: true,
                order: [
                    [1, 'desc']
                ],
                pageLength: 25,
            });
            let table = $('.datatable-storeOrders:not(.ajaxTable)').DataTable({
                buttons: dtButtons
            })
            $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e) {
                $($.fn.dataTable.tables(true)).DataTable()
                    .columns.adjust();
            });

        })
    </script>
@endsection
