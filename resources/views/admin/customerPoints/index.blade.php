@extends('layouts.admin')
@section('content')
@can('customer_point_create')
    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            <a class="btn btn-success" href="{{ route('admin.customer-points.create') }}">
                {{ trans('global.add') }} {{ trans('cruds.customerPoint.title_singular') }}
            </a>
        </div>
    </div>
@endcan
<div class="card">
    <div class="card-header">
        {{ trans('cruds.customerPoint.title_singular') }} {{ trans('global.list') }}
    </div>

    <div class="card-body">
        <table class=" table table-bordered table-striped table-hover ajaxTable datatable datatable-CustomerPoint">
            <thead>
                <tr>
                    <th width="10">

                    </th>
                    <th>
                        {{ trans('cruds.customerPoint.fields.id') }}
                    </th>
                    <th>
                        {{ trans('cruds.customerPoint.fields.user') }}
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
        </table>
    </div>
</div>



@endsection
@section('scripts')
@parent
<script>
    $(function () {
  let dtButtons = $.extend(true, [], $.fn.dataTable.defaults.buttons)
@can('customer_point_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}';
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.customer-points.massDestroy') }}",
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
    ajax: "{{ route('admin.customer-points.index') }}",
    columns: [
      { data: 'placeholder', name: 'placeholder' },
{ data: 'id', name: 'id' },
{ data: 'user_name', name: 'user.name' },
{ data: 'points', name: 'points' },
{ data: 'order_order_num', name: 'order.order_num' },
{ data: 'product_name', name: 'product.name' },
{ data: 'product_quantity', name: 'product_quantity' },
{ data: 'refunded', name: 'refunded' },
{ data: 'converted', name: 'converted' },
{ data: 'actions', name: '{{ trans('global.actions') }}' }
    ],
    orderCellsTop: true,
    order: [[ 1, 'desc' ]],
    pageLength: 25,
  };
  let table = $('.datatable-CustomerPoint').DataTable(dtOverrideGlobals);
  $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });
  
});

</script>
@endsection