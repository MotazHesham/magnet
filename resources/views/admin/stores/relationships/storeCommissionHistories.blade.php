<div class="card">
    <div class="card-body">
        <div class="table-responsive">
            <table class=" table table-bordered table-striped table-hover datatable datatable-storeCommissionHistories">
                <thead>
                    <tr>
                        <th width="10">

                        </th>
                        <th>
                            {{ trans('cruds.commissionHistory.fields.id') }}
                        </th>
                        <th>
                            {{ trans('cruds.commissionHistory.fields.order') }}
                        </th>
                        <th>
                            {{ trans('cruds.commissionHistory.fields.order_detail') }}
                        </th>
                        <th>
                            {{ trans('cruds.commissionHistory.fields.admin_commission') }}
                        </th>
                        <th>
                            {{ trans('cruds.commissionHistory.fields.store_earning') }}
                        </th>
                        <th>
                            &nbsp;
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($commissionHistories as $key => $commissionHistory)
                        <tr data-entry-id="{{ $commissionHistory->id }}">
                            <td>

                            </td>
                            <td>
                                {{ $commissionHistory->id ?? '' }}
                            </td>
                            <td>
                                {{ $commissionHistory->order->order_num ?? '' }}
                            </td>
                            <td>
                                {{ $commissionHistory->order_detail->note ?? '' }}
                            </td>
                            <td>
                                {{ $commissionHistory->admin_commission ?? '' }}
                            </td>
                            <td>
                                {{ $commissionHistory->store_earning ?? '' }}
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
            let table = $('.datatable-storeCommissionHistories:not(.ajaxTable)').DataTable({
                buttons: dtButtons
            })
            $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e) {
                $($.fn.dataTable.tables(true)).DataTable()
                    .columns.adjust();
            });

        })
    </script>
@endsection
