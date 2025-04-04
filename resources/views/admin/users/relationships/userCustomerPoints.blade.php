<div class="card">

    <div class="card-body">
        <div class="table-responsive">
            <table class=" table table-bordered table-striped table-hover datatable datatable-userCustomerPoints">
                <thead>
                    <tr>
                        <th width="10">

                        </th>
                        <th>
                            {{ trans('cruds.customerPoint.fields.id') }}
                        </th>
                        <th>
                            {{ trans('cruds.customerPoint.fields.points') }}
                        </th>
                        <th>
                            {{ trans('cruds.customerPoint.fields.order') }}
                        </th>
                        <th>
                            {{ trans('cruds.customerPoint.fields.product') }}
                        </th>
                        <th>
                            {{ trans('cruds.customerPoint.fields.product_quantity') }}
                        </th>
                        <th>
                            {{ trans('cruds.customerPoint.fields.refunded') }}
                        </th>
                        <th>
                            {{ trans('cruds.customerPoint.fields.converted') }}
                        </th>
                        <th>
                            &nbsp;
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($customerPoints as $key => $customerPoint)
                        <tr data-entry-id="{{ $customerPoint->id }}">
                            <td>

                            </td>
                            <td>
                                {{ $customerPoint->id ?? '' }}
                            </td>
                            <td>
                                {{ $customerPoint->points ?? '' }}
                            </td>
                            <td>
                                {{ $customerPoint->order->order_num ?? '' }}
                            </td>
                            <td>
                                {{ $customerPoint->product->name ?? '' }}
                            </td>
                            <td>
                                {{ $customerPoint->product_quantity ?? '' }}
                            </td>
                            <td>
                                <span style="display:none">{{ $customerPoint->refunded ?? '' }}</span>
                                <input type="checkbox" disabled="disabled"
                                    {{ $customerPoint->refunded ? 'checked' : '' }}>
                            </td>
                            <td>
                                <span style="display:none">{{ $customerPoint->converted ?? '' }}</span>
                                <input type="checkbox" disabled="disabled"
                                    {{ $customerPoint->converted ? 'checked' : '' }}>
                            </td>
                            <td>

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
            let table = $('.datatable-userCustomerPoints:not(.ajaxTable)').DataTable({
                buttons: dtButtons
            })
            $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e) {
                $($.fn.dataTable.tables(true)).DataTable()
                    .columns.adjust();
            });

        })
    </script>
@endsection
