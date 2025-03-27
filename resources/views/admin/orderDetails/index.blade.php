@extends('layouts.admin')
@section('content')
@can('order_detail_create')
    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            <a class="btn btn-success" href="{{ route('admin.order-details.create') }}">
                {{ trans('global.add') }} {{ trans('cruds.orderDetail.title_singular') }}
            </a>
        </div>
    </div>
@endcan
<div class="card">
    <div class="card-header">
        {{ trans('cruds.orderDetail.title_singular') }} {{ trans('global.list') }}
    </div>

    <div class="card-body">
        <table class=" table table-bordered table-striped table-hover ajaxTable datatable datatable-OrderDetail">
            <thead>
                <tr>
                    <th width="10">

                    </th>
                    <th>
                        {{ trans('cruds.orderDetail.fields.id') }}
                    </th>
                    <th>
                        {{ trans('cruds.orderDetail.fields.store') }}
                    </th>
                    <th>
                        {{ trans('cruds.orderDetail.fields.order') }}
                    </th>
                    <th>
                        {{ trans('cruds.orderDetail.fields.product') }}
                    </th>
                    <th>
                        {{ trans('cruds.orderDetail.fields.price') }}
                    </th>
                    <th>
                        {{ trans('cruds.orderDetail.fields.note') }}
                    </th>
                    <th>
                        {{ trans('cruds.orderDetail.fields.variant') }}
                    </th>
                    <th>
                        {{ trans('cruds.orderDetail.fields.quantity') }}
                    </th>
                    <th>
                        {{ trans('cruds.orderDetail.fields.earn_point') }}
                    </th>
                    <th>
                        &nbsp;
                    </th>
                </tr>
            </thead>
        </table>
    </div>
</div>



@endsection
@section('scripts')
@parent
<script>
    $(function () {
  let dtButtons = $.extend(true, [], $.fn.dataTable.defaults.buttons)
@can('order_detail_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}';
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.order-details.massDestroy') }}",
    className: 'btn-danger',
    action: function (e, dt, node, config) {
      var ids = $.map(dt.rows({ selected: true }).data(), function (entry) {
          return entry.id
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

  let dtOverrideGlobals = {
    buttons: dtButtons,
    processing: true,
    serverSide: true,
    retrieve: true,
    aaSorting: [],
    ajax: "{{ route('admin.order-details.index') }}",
    columns: [
      { data: 'placeholder', name: 'placeholder' },
{ data: 'id', name: 'id' },
{ data: 'store_store_name', name: 'store.store_name' },
{ data: 'order_order_num', name: 'order.order_num' },
{ data: 'product_name', name: 'product.name' },
{ data: 'price', name: 'price' },
{ data: 'note', name: 'note' },
{ data: 'variant', name: 'variant' },
{ data: 'quantity', name: 'quantity' },
{ data: 'earn_point', name: 'earn_point' },
{ data: 'actions', name: '{{ trans('global.actions') }}' }
    ],
    orderCellsTop: true,
    order: [[ 1, 'desc' ]],
    pageLength: 25,
  };
  let table = $('.datatable-OrderDetail').DataTable(dtOverrideGlobals);
  $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });
  
});

</script>
@endsection