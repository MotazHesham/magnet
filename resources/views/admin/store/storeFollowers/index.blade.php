@extends('layouts.admin')
@section('content')
    <div class="card">
        <div class="card-header">
       <div class="card-title">
            {{ trans('cruds.storeFollower.title') }}
        </div>

        <div class="card-body">
            <table class=" table table-bordered table-striped table-hover ajaxTable datatable datatable-StoreFollower">
                <thead>
                    <tr>
                        <th width="10">

                        </th>
                        <th>
                            {{ trans('cruds.storeFollower.fields.id') }}
                        </th>
                        <th>
                            {{ trans('cruds.storeFollower.fields.store') }}
                        </th>
                        <th>
                            {{ trans('cruds.storeFollower.fields.user') }}
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
                ajax: "{{ route('admin.store-followers.index') }}",
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
                        data: 'user_name',
                        name: 'user.name'
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
            let table = $('.datatable-StoreFollower').DataTable(dtOverrideGlobals);
            $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e) {
                $($.fn.dataTable.tables(true)).DataTable()
                    .columns.adjust();
            });

        });
    </script>
@endsection
