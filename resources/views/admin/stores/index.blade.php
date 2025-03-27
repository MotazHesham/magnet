@extends('layouts.admin')
@section('content')
@can('store_create')
    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            <a class="btn btn-success" href="{{ route('admin.stores.create') }}">
                {{ trans('global.add') }} {{ trans('cruds.store.title_singular') }}
            </a>
        </div>
    </div>
@endcan
<div class="card">
    <div class="card-header">
        {{ trans('cruds.store.title_singular') }} {{ trans('global.list') }}
    </div>

    <div class="card-body">
        <table class=" table table-bordered table-striped table-hover ajaxTable datatable datatable-Store">
            <thead>
                <tr>
                    <th width="10">

                    </th>
                    <th>
                        {{ trans('cruds.store.fields.id') }}
                    </th>
                    <th>
                        {{ trans('cruds.store.fields.store_type') }}
                    </th>
                    <th>
                        {{ trans('cruds.store.fields.store_name') }}
                    </th>
                    <th>
                        {{ trans('cruds.store.fields.logo') }}
                    </th>
                    <th>
                        {{ trans('cruds.store.fields.city') }}
                    </th>
                    <th>
                        {{ trans('cruds.store.fields.store_phone') }}
                    </th>
                    <th>
                        {{ trans('cruds.store.fields.domain') }}
                    </th>
                    <th>
                        {{ trans('cruds.store.fields.categories') }}
                    </th>
                    <th>
                        {{ trans('cruds.store.fields.rating') }}
                    </th>
                    <th>
                        {{ trans('cruds.store.fields.admin_to_pay') }}
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
@can('store_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}';
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.stores.massDestroy') }}",
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
    ajax: "{{ route('admin.stores.index') }}",
    columns: [
      { data: 'placeholder', name: 'placeholder' },
{ data: 'id', name: 'id' },
{ data: 'store_type', name: 'store_type' },
{ data: 'store_name', name: 'store_name' },
{ data: 'logo', name: 'logo', sortable: false, searchable: false },
{ data: 'city_name', name: 'city.name' },
{ data: 'store_phone', name: 'store_phone' },
{ data: 'domain', name: 'domain' },
{ data: 'categories', name: 'categories.name' },
{ data: 'rating', name: 'rating' },
{ data: 'admin_to_pay', name: 'admin_to_pay' },
{ data: 'actions', name: '{{ trans('global.actions') }}' }
    ],
    orderCellsTop: true,
    order: [[ 1, 'desc' ]],
    pageLength: 25,
  };
  let table = $('.datatable-Store').DataTable(dtOverrideGlobals);
  $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });
  
});

</script>
@endsection