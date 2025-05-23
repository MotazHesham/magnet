@extends('layouts.admin')
@section('content')
    <div class="card">
        <div class="card-header">
       <div class="card-title">
            {{ trans('cruds.storeCity.title') }}
        </div>

        <div class="card-body">
            <table class=" table table-bordered table-striped table-hover ajaxTable datatable datatable-StoreCity">
                <thead>
                    <tr>
                        <th width="10">

                        </th>
                        <th>
                            {{ trans('cruds.storeCity.fields.id') }}
                        </th>
                        <th>
                            {{ trans('cruds.storeCity.fields.store') }}
                        </th>
                        <th>
                            {{ trans('cruds.storeCity.fields.city') }}
                        </th>
                        <th>
                            {{ trans('cruds.storeCity.fields.price') }}
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
                ajax: "{{ route('admin.store-cities.index') }}",
                columns: [{
                        data: 'placeholder',
                        name: 'placeholder'
                    },
                    {
                        data: 'id',
                        name: 'id'
                    },
                    {
                        data: 'store_store_name',
                        name: 'store.store_name'
                    },
                    {
                        data: 'city_name',
                        name: 'city.name'
                    },
                    {
                        data: 'price',
                        name: 'price'
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
            let table = $('.datatable-StoreCity').DataTable(dtOverrideGlobals);
            $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e) {
                $($.fn.dataTable.tables(true)).DataTable()
                    .columns.adjust();
            });

        });
    </script>
@endsection
