<div class="card">

    <div class="card-body">
        <div class="table-responsive">
            <table class=" table table-bordered table-striped table-hover datatable datatable-userProductReviews">
                <thead>
                    <tr>
                        <th width="10">

                        </th>
                        <th>
                            {{ trans('cruds.productReview.fields.id') }}
                        </th>
                        <th>
                            {{ trans('cruds.productReview.fields.rate') }}
                        </th>
                        <th>
                            {{ trans('cruds.productReview.fields.review') }}
                        </th>
                        <th>
                            {{ trans('cruds.productReview.fields.product') }}
                        </th>
                        <th>
                            &nbsp;
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($productReviews as $key => $productReview)
                        <tr data-entry-id="{{ $productReview->id }}">
                            <td>

                            </td>
                            <td>
                                {{ $productReview->id ?? '' }}
                            </td>
                            <td>
                                {{ $productReview->rate ?? '' }}
                            </td>
                            <td>
                                {{ $productReview->review ?? '' }}
                            </td>
                            <td>
                                {{ $productReview->product->name ?? '' }}
                            </td>
                            <td>

                                @can('product_review_delete')
                                    <form action="{{ route('admin.product-reviews.destroy', $productReview->id) }}"
                                        method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');"
                                        style="display: inline-block;">
                                        <input type="hidden" name="_method" value="DELETE">
                                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                        <input type="submit" class="btn btn-xs btn-danger"
                                            value="{{ trans('global.delete') }}">
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
        $(function() {
            let dtButtons = $.extend(true, [], $.fn.dataTable.defaults.buttons)
            @can('product_review_delete')
                let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
                let deleteButton = {
                    text: deleteButtonTrans,
                    url: "{{ route('admin.product-reviews.massDestroy') }}",
                    className: 'btn-danger-light rounded-pill',
                    action: function(e, dt, node, config) {
                        var ids = $.map(dt.rows({
                            selected: true
                        }).nodes(), function(entry) {
                            return $(entry).data('entry-id')
                        });

                        if (ids.length === 0) {
                            alert('{{ trans('global.datatables.zero_selected') }}')

                            return
                        }

                        if (confirm('{{ trans('global.areYouSure') }}')) {
                            $.ajax({
                                    headers: {
                                        'x-csrf-token': _token
                                    },
                                    method: 'POST',
                                    url: config.url,
                                    data: {
                                        ids: ids,
                                        _method: 'DELETE'
                                    }
                                })
                                .done(function() {
                                    location.reload()
                                })
                        }
                    }
                }
                dtButtons.push(deleteButton)
            @endcan

            $.extend(true, $.fn.dataTable.defaults, {
                orderCellsTop: true,
                order: [
                    [1, 'desc']
                ],
                pageLength: 25,
            });
            let table = $('.datatable-userProductReviews:not(.ajaxTable)').DataTable({
                buttons: dtButtons
            })
            $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e) {
                $($.fn.dataTable.tables(true)).DataTable()
                    .columns.adjust();
            });

        })
    </script>
@endsection
