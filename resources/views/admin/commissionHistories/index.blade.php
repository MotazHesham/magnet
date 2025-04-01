@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('cruds.commissionHistory.title') }}
    </div>

    <div class="card-body">
        <table class=" table table-bordered table-striped table-hover ajaxTable datatable datatable-CommissionHistory">
            <thead>
                <tr>
                    <th width="10">

                    </th>
                    <th>
                        {{ trans('cruds.commissionHistory.fields.id') }}
                    </th>
                    <th>
                        {{ trans('cruds.commissionHistory.fields.store') }}
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
        </table>
    </div>
</div>



@endsection
@section('scripts')
@parent
<script>
    $(function () {
  let dtButtons = $.extend(true, [], $.fn.dataTable.defaults.buttons)
  
  let dtOverrideGlobals = {
    buttons: dtButtons,
    processing: true,
    serverSide: true,
    retrieve: true,
    aaSorting: [],
    ajax: "{{ route('admin.commission-histories.index') }}",
    columns: [
      { data: 'placeholder', name: 'placeholder' },
{ data: 'id', name: 'id' },
{ data: 'store_store_name', name: 'store.store_name' },
{ data: 'order_order_num', name: 'order.order_num' },
{ data: 'order_detail_note', name: 'order_detail.note' },
{ data: 'admin_commission', name: 'admin_commission' },
{ data: 'store_earning', name: 'store_earning' },
{ data: 'actions', name: '{{ trans('global.actions') }}' }
    ],
    orderCellsTop: true,
    order: [[ 1, 'desc' ]],
    pageLength: 25,
  };
  let table = $('.datatable-CommissionHistory').DataTable(dtOverrideGlobals);
  $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });
  
});

</script>
@endsection