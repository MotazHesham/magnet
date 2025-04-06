<div class="card">

    <div class="card-body">
        <div class="table-responsive">
            <table class=" table table-bordered table-striped table-hover datatable datatable-storeStoreCities">
                <thead>
                    <tr>
                        <th width="10">

                        </th>
                        <th>
                            {{ trans('cruds.storeCity.fields.id') }}
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
                <tbody>
                    @foreach ($storeCities as $key => $storeCity)
                        <tr data-entry-id="{{ $storeCity->id }}">
                            <td>

                            </td>
                            <td>
                                {{ $storeCity->id ?? '' }}
                            </td>
                            <td>
                                {{ $storeCity->city->name ?? '' }}
                            </td>
                            <td>
                                {{ $storeCity->price ?? '' }}
                            </td>
                            <td> 

                                @can('store_city_edit')
                                    <a class="btn btn-xs btn-info"
                                        href="{{ route('admin.store-cities.edit', $storeCity->id) }}">
                                        {{ trans('global.edit') }}
                                    </a>
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
        $(function() {
            let dtButtons = $.extend(true, [], $.fn.dataTable.defaults.buttons)

            $.extend(true, $.fn.dataTable.defaults, {
                orderCellsTop: true,
                order: [
                    [1, 'desc']
                ],
                pageLength: 25,
            });
            let table = $('.datatable-storeStoreCities:not(.ajaxTable)').DataTable({
                buttons: dtButtons
            })
            $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e) {
                $($.fn.dataTable.tables(true)).DataTable()
                    .columns.adjust();
            });

        })
    </script>
@endsection
