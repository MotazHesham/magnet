<div class="card">

    <div class="card-body">
        <div class="table-responsive">
            <table
                class=" table table-bordered table-striped table-hover datatable datatable-storeStoreWithdrawRequests">
                <thead>
                    <tr>
                        <th width="10">

                        </th>
                        <th>
                            {{ trans('cruds.storeWithdrawRequest.fields.id') }}
                        </th>
                        <th>
                            {{ trans('cruds.storeWithdrawRequest.fields.amount') }}
                        </th>
                        <th>
                            {{ trans('cruds.storeWithdrawRequest.fields.note') }}
                        </th>
                        <th>
                            {{ trans('cruds.storeWithdrawRequest.fields.status') }}
                        </th>
                        <th>
                            &nbsp;
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($storeWithdrawRequests as $key => $storeWithdrawRequest)
                        <tr data-entry-id="{{ $storeWithdrawRequest->id }}">
                            <td>

                            </td>
                            <td>
                                {{ $storeWithdrawRequest->id ?? '' }}
                            </td>
                            <td>
                                {{ $storeWithdrawRequest->amount ?? '' }}
                            </td>
                            <td>
                                {{ $storeWithdrawRequest->note ?? '' }}
                            </td>
                            <td>
                                {{ App\Models\StoreWithdrawRequest::STATUS_SELECT[$storeWithdrawRequest->status] ?? '' }}
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
            let table = $('.datatable-storeStoreWithdrawRequests:not(.ajaxTable)').DataTable({
                buttons: dtButtons
            })
            $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e) {
                $($.fn.dataTable.tables(true)).DataTable()
                    .columns.adjust();
            });

        })
    </script>
@endsection
