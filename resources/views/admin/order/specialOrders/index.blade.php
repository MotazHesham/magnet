@extends('layouts.admin')
@section('content')
    @can('special_order_create')
        <div style="margin-bottom: 10px;" class="row">
            <div class="col-lg-12">
                <a class="btn btn-success-light rounded-pill" href="{{ route('admin.special-orders.create') }}">
                    {{ trans('global.add') }} {{ trans('cruds.specialOrder.title_singular') }}
                </a>
            </div>
        </div>
    @endcan
    <div class="card">
        <div class="card-header">
       <div class="card-title">
            {{ trans('cruds.specialOrder.title') }}
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
        $(function() {
            let dtButtons = $.extend(true, [], $.fn.dataTable.defaults.buttons) 

            let dtOverrideGlobals = {
                buttons: dtButtons,
                processing: true,
                serverSide: true,
                retrieve: true,
                aaSorting: [],
                ajax: "{{ route('admin.special-orders.index') }}",
                columns: [{
                        data: 'placeholder',
                        name: 'placeholder'
                    },
                    {
                        data: 'id',
                        name: 'id'
                    },
                    {
                        data: 'order_num',
                        name: 'order_num'
                    },
                    {
                        data: 'user_name',
                        name: 'user.name'
                    },
                    {
                        data: 'store_store_name',
                        name: 'store.store_name'
                    }, 
                    {
                        data: 'delivery_status',
                        name: 'delivery_status'
                    },
                    {
                        data: 'offer_price_status',
                        name: 'offer_price_status'
                    },
                    {
                        data: 'payment_method',
                        name: 'payment_method'
                    },
                    {
                        data: 'payment_status',
                        name: 'payment_status'
                    }, 
                    {
                        data: 'total',
                        name: 'total'
                    },
                    {
                        data: 'created_at',
                        name: 'created_at'
                    },
                    {
                        data: 'actions',
                        name: '{{ trans('global.actions') }}'
                    }
                ],
                orderCellsTop: true,
                order: [
                    [1, 'desc']
                ],
                pageLength: 25,
            };
            let table = $('.datatable-SpecialOrder').DataTable(dtOverrideGlobals);
            $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e) {
                $($.fn.dataTable.tables(true)).DataTable()
                    .columns.adjust();
            });

        });
    </script>
@endsection
