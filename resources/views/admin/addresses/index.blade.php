@extends('layouts.admin')
@section('content') 
    <div class="card">
        <div class="card-header">
            {{ trans('cruds.address.title') }}
        </div>

        <div class="card-body">
            <table class=" table table-bordered table-striped table-hover ajaxTable datatable datatable-Address">
                <thead>
                    <tr>
                        <th width="10">

                        </th>
                        <th>
                            {{ trans('cruds.address.fields.id') }}
                        </th>
                        <th>
                            {{ trans('cruds.address.fields.user') }}
                        </th>
                        <th>
                            {{ trans('cruds.address.fields.name') }}
                        </th>
                        <th>
                            {{ trans('cruds.address.fields.region') }}
                        </th>
                        <th>
                            {{ trans('cruds.address.fields.city') }}
                        </th>
                        <th>
                            {{ trans('cruds.address.fields.district') }}
                        </th>
                        <th>
                            {{ trans('cruds.address.fields.address') }}
                        </th>
                        <th>
                            {{ trans('cruds.address.fields.is_default') }}
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
                ajax: "{{ route('admin.addresses.index') }}",
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
                        data: 'name',
                        name: 'name'
                    },
                    {
                        data: 'region_name',
                        name: 'region.name'
                    },
                    {
                        data: 'city_name',
                        name: 'city.name'
                    },
                    {
                        data: 'district_name',
                        name: 'district.name'
                    },
                    {
                        data: 'address',
                        name: 'address'
                    },
                    {
                        data: 'is_default',
                        name: 'is_default'
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
            let table = $('.datatable-Address').DataTable(dtOverrideGlobals);
            $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e) {
                $($.fn.dataTable.tables(true)).DataTable()
                    .columns.adjust();
            });

        });
    </script>
@endsection
