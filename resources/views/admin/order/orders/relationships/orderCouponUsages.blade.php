@can('coupon_usage_create')
    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            <a class="btn btn-success" href="{{ route('admin.coupon-usages.create') }}">
                {{ trans('global.add') }} {{ trans('cruds.couponUsage.title_singular') }}
            </a>
        </div>
    </div>
@endcan

<div class="card">
    <div class="card-header">
        {{ trans('cruds.couponUsage.title') }}
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table class=" table table-bordered table-striped table-hover datatable datatable-orderCouponUsages">
                <thead>
                    <tr>
                        <th width="10">

                        </th>
                        <th>
                            {{ trans('cruds.couponUsage.fields.id') }}
                        </th>
                        <th>
                            {{ trans('cruds.couponUsage.fields.coupon') }}
                        </th>
                        <th>
                            {{ trans('cruds.couponUsage.fields.user') }}
                        </th>
                        <th>
                            {{ trans('cruds.couponUsage.fields.order') }}
                        </th>
                        <th>
                            {{ trans('cruds.couponUsage.fields.discount') }}
                        </th>
                        <th>
                            &nbsp;
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($couponUsages as $key => $couponUsage)
                        <tr data-entry-id="{{ $couponUsage->id }}">
                            <td>

                            </td>
                            <td>
                                {{ $couponUsage->id ?? '' }}
                            </td>
                            <td>
                                {{ $couponUsage->coupon->name ?? '' }}
                            </td>
                            <td>
                                {{ $couponUsage->user->name ?? '' }}
                            </td>
                            <td>
                                {{ $couponUsage->order->order_num ?? '' }}
                            </td>
                            <td>
                                {{ $couponUsage->discount ?? '' }}
                            </td>
                            <td>
                                @can('coupon_usage_show')
                                    <a class="btn btn-xs btn-primary" href="{{ route('admin.coupon-usages.show', $couponUsage->id) }}">
                                        {{ trans('global.view') }}
                                    </a>
                                @endcan

                                @can('coupon_usage_edit')
                                    <a class="btn btn-xs btn-info" href="{{ route('admin.coupon-usages.edit', $couponUsage->id) }}">
                                        {{ trans('global.edit') }}
                                    </a>
                                @endcan

                                @can('coupon_usage_delete')
                                    <form action="{{ route('admin.coupon-usages.destroy', $couponUsage->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
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
@can('coupon_usage_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.coupon-usages.massDestroy') }}",
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
  let table = $('.datatable-orderCouponUsages:not(.ajaxTable)').DataTable({ buttons: dtButtons })
  $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });
  
})

</script>
@endsection