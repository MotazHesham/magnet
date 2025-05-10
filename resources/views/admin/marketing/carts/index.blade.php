@extends('layouts.admin')
@section('content')
    <div class="card">
        <div class="card-header">
       <div class="card-title">
            {{ trans('cruds.cart.title') }}
        </div>

        <div class="card-body">
            <table class=" table table-bordered table-striped table-hover ajaxTable datatable datatable-Cart">
                <thead>
                    <tr>
                        <th width="10">

                        </th>
                        <th>
                            {{ trans('cruds.cart.fields.id') }}
                        </th>
                        <th>
                            {{ trans('cruds.cart.fields.user') }}
                        </th>
                        <th>
                            {{ trans('cruds.cart.fields.temp_user_uid') }}
                        </th>
                        <th>
                            {{ trans('cruds.cart.fields.product') }}
                        </th>
                        <th>
                            {{ trans('cruds.cart.fields.store') }}
                        </th>
                        <th>
                            {{ trans('cruds.cart.fields.quantity') }}
                        </th>
                        <th>
                            {{ trans('cruds.cart.fields.note') }}
                        </th>
                        <th>
                            {{ trans('cruds.cart.fields.variant') }}
                        </th>
                        <th>
                            {{ trans('cruds.cart.fields.created_at') }}
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
                ajax: "{{ route('admin.carts.index') }}",
                columns: [{
                        data: 'placeholder',
                        name: 'placeholder'
                    },
                    {
                        data: 'id',
                        name: 'id'
                    },
                    {
                        data: 'user_name',
                        name: 'user.name'
                    },
                    {
                        data: 'temp_user_uid',
                        name: 'temp_user_uid'
                    },
                    {
                        data: 'product_name',
                        name: 'product.name'
                    },
                    {
                        data: 'store_store_name',
                        name: 'store.store_name'
                    },
                    {
                        data: 'quantity',
                        name: 'quantity'
                    },
                    {
                        data: 'note',
                        name: 'note'
                    },
                    {
                        data: 'variant',
                        name: 'variant'
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
            let table = $('.datatable-Cart').DataTable(dtOverrideGlobals);
            $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e) {
                $($.fn.dataTable.tables(true)).DataTable()
                    .columns.adjust();
            });

        });
    </script>
@endsection
