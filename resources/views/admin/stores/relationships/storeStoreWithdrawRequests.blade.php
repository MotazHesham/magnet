@can('store_withdraw_request_create')
    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            <a class="btn btn-success" href="{{ route('admin.store-withdraw-requests.create') }}">
                {{ trans('global.add') }} {{ trans('cruds.storeWithdrawRequest.title_singular') }}
            </a>
        </div>
    </div>
@endcan

<div class="card">
    <div class="card-header">
        {{ trans('cruds.storeWithdrawRequest.title') }}
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table class=" table table-bordered table-striped table-hover datatable datatable-storeStoreWithdrawRequests">
                <thead>
                    <tr>
                        <th width="10">

                        </th>
                        <th>
                            {{ trans('cruds.storeWithdrawRequest.fields.id') }}
                        </th>
                        <th>
                            {{ trans('cruds.storeWithdrawRequest.fields.store') }}
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
                    @foreach($storeWithdrawRequests as $key => $storeWithdrawRequest)
                        <tr data-entry-id="{{ $storeWithdrawRequest->id }}">
                            <td>

                            </td>
                            <td>
                                {{ $storeWithdrawRequest->id ?? '' }}
                            </td>
                            <td>
                                {{ $storeWithdrawRequest->store->store_name ?? '' }}
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
                                @can('store_withdraw_request_show')
                                    <a class="btn btn-xs btn-primary" href="{{ route('admin.store-withdraw-requests.show', $storeWithdrawRequest->id) }}">
                                        {{ trans('global.view') }}
                                    </a>
                                @endcan

                                @can('store_withdraw_request_edit')
                                    <a class="btn btn-xs btn-info" href="{{ route('admin.store-withdraw-requests.edit', $storeWithdrawRequest->id) }}">
                                        {{ trans('global.edit') }}
                                    </a>
                                @endcan

                                @can('store_withdraw_request_delete')
                                    <form action="{{ route('admin.store-withdraw-requests.destroy', $storeWithdrawRequest->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
                                        <input type="hidden" name="_method" value="DELETE">
                                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                        <input type="submit" class="btn btn-xs btn-danger" value="{{ trans('global.delete') }}">
                                    </form>
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
    $(function () {
  let dtButtons = $.extend(true, [], $.fn.dataTable.defaults.buttons)
@can('store_withdraw_request_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.store-withdraw-requests.massDestroy') }}",
    className: 'btn-danger',
    action: function (e, dt, node, config) {
      var ids = $.map(dt.rows({ selected: true }).nodes(), function (entry) {
          return $(entry).data('entry-id')
      });

      if (ids.length === 0) {
        alert('{{ trans('global.datatables.zero_selected') }}')

        return
      }

      if (confirm('{{ trans('global.areYouSure') }}')) {
        $.ajax({
          headers: {'x-csrf-token': _token},
          method: 'POST',
          url: config.url,
          data: { ids: ids, _method: 'DELETE' }})
          .done(function () { location.reload() })
      }
    }
  }
  dtButtons.push(deleteButton)
@endcan

  $.extend(true, $.fn.dataTable.defaults, {
    orderCellsTop: true,
    order: [[ 1, 'desc' ]],
    pageLength: 25,
  });
  let table = $('.datatable-storeStoreWithdrawRequests:not(.ajaxTable)').DataTable({ buttons: dtButtons })
  $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });
  
})

</script>
@endsection