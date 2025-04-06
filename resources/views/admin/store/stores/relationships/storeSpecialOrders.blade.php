<div class="card">

    <div class="card-body">
        <div class="table-responsive">
            <table class=" table table-bordered table-striped table-hover datatable datatable-storeSpecialOrders">
                <thead>
                    <tr>
                        <th width="10">

                        </th>
                        <th>
                            {{ trans('cruds.specialOrder.fields.id') }}
                        </th>
                        <th>
                            {{ trans('cruds.specialOrder.fields.order_num') }}
                        </th>
                        <th>
                            {{ trans('cruds.specialOrder.fields.user') }}
                        </th>
                        <th>
                            {{ trans('cruds.specialOrder.fields.files') }}
                        </th>
                        <th>
                            {{ trans('cruds.specialOrder.fields.color') }}
                        </th>
                        <th>
                            {{ trans('cruds.specialOrder.fields.category') }}
                        </th>
                        <th>
                            {{ trans('cruds.specialOrder.fields.description') }}
                        </th>
                        <th>
                            {{ trans('cruds.specialOrder.fields.delivery_status') }}
                        </th>
                        <th>
                            {{ trans('cruds.specialOrder.fields.offer_price_status') }}
                        </th>
                        <th>
                            {{ trans('cruds.specialOrder.fields.payment_method') }}
                        </th>
                        <th>
                            {{ trans('cruds.specialOrder.fields.payment_status') }}
                        </th>
                        <th>
                            {{ trans('cruds.specialOrder.fields.shipping_cost') }}
                        </th>
                        <th>
                            {{ trans('cruds.specialOrder.fields.total') }}
                        </th>
                        <th>
                            {{ trans('cruds.specialOrder.fields.created_at') }}
                        </th>
                        <th>
                            &nbsp;
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($specialOrders as $key => $specialOrder)
                        <tr data-entry-id="{{ $specialOrder->id }}">
                            <td>

                            </td>
                            <td>
                                {{ $specialOrder->id ?? '' }}
                            </td>
                            <td>
                                {{ $specialOrder->order_num ?? '' }}
                            </td>
                            <td>
                                {{ $specialOrder->user->name ?? '' }}
                            </td>
                            <td>
                                @foreach ($specialOrder->files as $key => $media)
                                    <a href="{{ $media->getUrl() }}" target="_blank">
                                        {{ trans('global.view_file') }}
                                    </a>
                                @endforeach
                            </td>
                            <td>
                                {{ $specialOrder->color ?? '' }}
                            </td>
                            <td>
                                {{ $specialOrder->category->name ?? '' }}
                            </td>
                            <td>
                                {{ $specialOrder->description ?? '' }}
                            </td>
                            <td>
                                {{ App\Models\SpecialOrder::DELIVERY_STATUS_SELECT[$specialOrder->delivery_status] ?? '' }}
                            </td>
                            <td>
                                {{ App\Models\SpecialOrder::OFFER_PRICE_STATUS_SELECT[$specialOrder->offer_price_status] ?? '' }}
                            </td>
                            <td>
                                {{ App\Models\SpecialOrder::PAYMENT_METHOD_SELECT[$specialOrder->payment_method] ?? '' }}
                            </td>
                            <td>
                                {{ App\Models\SpecialOrder::PAYMENT_STATUS_SELECT[$specialOrder->payment_status] ?? '' }}
                            </td>
                            <td>
                                {{ $specialOrder->shipping_cost ?? '' }}
                            </td>
                            <td>
                                {{ $specialOrder->total ?? '' }}
                            </td>
                            <td>
                                {{ $specialOrder->created_at ?? '' }}
                            </td>
                            <td>
                                @can('special_order_show')
                                    <a class="btn btn-xs btn-primary"
                                        href="{{ route('admin.special-orders.show', $specialOrder->id) }}">
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
            let table = $('.datatable-storeSpecialOrders:not(.ajaxTable)').DataTable({
                buttons: dtButtons
            })
            $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e) {
                $($.fn.dataTable.tables(true)).DataTable()
                    .columns.adjust();
            });

        })
    </script>
@endsection
