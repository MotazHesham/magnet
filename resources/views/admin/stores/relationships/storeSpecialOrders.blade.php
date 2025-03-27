@can('special_order_create')
    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            <a class="btn btn-success" href="{{ route('admin.special-orders.create') }}">
                {{ trans('global.add') }} {{ trans('cruds.specialOrder.title_singular') }}
            </a>
        </div>
    </div>
@endcan

<div class="card">
    <div class="card-header">
        {{ trans('cruds.specialOrder.title_singular') }} {{ trans('global.list') }}
    </div>

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
                            {{ trans('cruds.specialOrder.fields.store') }}
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
                            &nbsp;
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($specialOrders as $key => $specialOrder)
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
                                {{ $specialOrder->store->store_name ?? '' }}
                            </td>
                            <td>
                                @foreach($specialOrder->files as $key => $media)
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
                                @can('special_order_show')
                                    <a class="btn btn-xs btn-primary" href="{{ route('admin.special-orders.show', $specialOrder->id) }}">
                                        {{ trans('global.view') }}
                                    </a>
                                @endcan

                                @can('special_order_edit')
                                    <a class="btn btn-xs btn-info" href="{{ route('admin.special-orders.edit', $specialOrder->id) }}">
                                        {{ trans('global.edit') }}
                                    </a>
                                @endcan

                                @can('special_order_delete')
                                    <form action="{{ route('admin.special-orders.destroy', $specialOrder->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
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
@can('special_order_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.special-orders.massDestroy') }}",
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
  let table = $('.datatable-storeSpecialOrders:not(.ajaxTable)').DataTable({ buttons: dtButtons })
  $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });
  
})

</script>
@endsection