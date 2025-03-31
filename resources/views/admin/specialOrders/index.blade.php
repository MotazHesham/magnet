@extends('layouts.admin')
@section('content')
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
        <table class=" table table-bordered table-striped table-hover ajaxTable datatable datatable-SpecialOrder">
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
                        {{ trans('cruds.specialOrder.fields.created_at') }}
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
@can('special_order_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}';
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.special-orders.massDestroy') }}",
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
    ajax: "{{ route('admin.special-orders.index') }}",
    columns: [
      { data: 'placeholder', name: 'placeholder' },
{ data: 'id', name: 'id' },
{ data: 'order_num', name: 'order_num' },
{ data: 'user_name', name: 'user.name' },
{ data: 'store_store_name', name: 'store.store_name' },
{ data: 'files', name: 'files', sortable: false, searchable: false },
{ data: 'color', name: 'color' },
{ data: 'category_name', name: 'category.name' },
{ data: 'description', name: 'description' },
{ data: 'delivery_status', name: 'delivery_status' },
{ data: 'offer_price_status', name: 'offer_price_status' },
{ data: 'payment_method', name: 'payment_method' },
{ data: 'payment_status', name: 'payment_status' },
{ data: 'shipping_cost', name: 'shipping_cost' },
{ data: 'total', name: 'total' },
{ data: 'created_at', name: 'created_at' },
{ data: 'actions', name: '{{ trans('global.actions') }}' }
    ],
    orderCellsTop: true,
    order: [[ 1, 'desc' ]],
    pageLength: 25,
  };
  let table = $('.datatable-SpecialOrder').DataTable(dtOverrideGlobals);
  $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });
  
});

</script>
@endsection