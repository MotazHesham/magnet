

<div class="card"> 

    <div class="card-body">
        <div class="table-responsive">
            <table class=" table table-bordered table-striped table-hover datatable datatable-userAddresses">
                <thead>
                    <tr>
                        <th width="10">

                        </th>
                        <th>
                            {{ trans('cruds.address.fields.id') }}
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
                <tbody>
                    @foreach ($addresses as $key => $address)
                        <tr data-entry-id="{{ $address->id }}">
                            <td>

                            </td>
                            <td>
                                {{ $address->id ?? '' }}
                            </td>
                            <td>
                                {{ $address->name ?? '' }}
                            </td>
                            <td>
                                {{ $address->region->name ?? '' }}
                            </td>
                            <td>
                                {{ $address->city->name ?? '' }}
                            </td>
                            <td>
                                {{ $address->district->name ?? '' }}
                            </td>
                            <td>
                                {{ $address->address ?? '' }}
                            </td>
                            <td>
                                <span style="display:none">{{ $address->is_default ?? '' }}</span>
                                <input type="checkbox" disabled="disabled" {{ $address->is_default ? 'checked' : '' }}>
                            </td>
                            <td>
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
            let table = $('.datatable-userAddresses:not(.ajaxTable)').DataTable({
                buttons: dtButtons
            })
            $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e) {
                $($.fn.dataTable.tables(true)).DataTable()
                    .columns.adjust();
            });

        })
    </script>
@endsection
