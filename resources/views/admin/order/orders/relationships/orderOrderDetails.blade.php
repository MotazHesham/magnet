@can('order_detail_create')
    <form method="POST" action="{{ route('admin.order-details.store') }}" enctype="multipart/form-data">
        @csrf
        <input type="hidden" name="store_id" value="{{ $order->store_id }}" id="">
        <input type="hidden" name="order_id" value="{{ $order->order_id }}" id="">

        <div class="row p-2">
            <div class="form-group col-md-4">
                <label for="product_id">{{ trans('cruds.orderDetail.fields.product') }}</label>
                <select class="form-control select2 {{ $errors->has('product') ? 'is-invalid' : '' }}" name="product_id"
                    id="product_id">
                    @foreach ($products as $id => $entry)
                        <option value="{{ $id }}" {{ old('product_id') == $id ? 'selected' : '' }}>
                            {{ $entry }}</option>
                    @endforeach
                </select>
                @if ($errors->has('product'))
                    <div class="invalid-feedback">
                        {{ $errors->first('product') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.orderDetail.fields.product_helper') }}</span>
            </div>
            <div class="form-group col-md-4">
                <label for="price">{{ trans('cruds.orderDetail.fields.price') }}</label>
                <input class="form-control {{ $errors->has('price') ? 'is-invalid' : '' }}" type="number" name="price"
                    id="price" value="{{ old('price', '') }}" step="0.01">
                @if ($errors->has('price'))
                    <div class="invalid-feedback">
                        {{ $errors->first('price') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.orderDetail.fields.price_helper') }}</span>
            </div>
            <div class="form-group col-md-4">
                <label for="note">{{ trans('cruds.orderDetail.fields.note') }}</label>
                <input class="form-control {{ $errors->has('note') ? 'is-invalid' : '' }}" type="text" name="note"
                    id="note" value="{{ old('note', '') }}">
                @if ($errors->has('note'))
                    <div class="invalid-feedback">
                        {{ $errors->first('note') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.orderDetail.fields.note_helper') }}</span>
            </div>
            <div class="form-group col-md-3">
                <label for="variation">{{ trans('cruds.orderDetail.fields.variation') }}</label>
                <input class="form-control {{ $errors->has('variation') ? 'is-invalid' : '' }}" type="text" name="variation"
                    id="variation" value="{{ old('variation', '') }}">
                @if ($errors->has('variation'))
                    <div class="invalid-feedback">
                        {{ $errors->first('variation') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.orderDetail.fields.variation_helper') }}</span>
            </div>
            <div class="form-group col-md-3">
                <label for="quantity">{{ trans('cruds.orderDetail.fields.quantity') }}</label>
                <input class="form-control {{ $errors->has('quantity') ? 'is-invalid' : '' }}" type="number"
                    name="quantity" id="quantity" value="{{ old('quantity', '') }}" step="1">
                @if ($errors->has('quantity'))
                    <div class="invalid-feedback">
                        {{ $errors->first('quantity') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.orderDetail.fields.quantity_helper') }}</span>
            </div>
            <div class="form-group col-md-3">
                <label for="earn_point">{{ trans('cruds.orderDetail.fields.earn_point') }}</label>
                <input class="form-control {{ $errors->has('earn_point') ? 'is-invalid' : '' }}" type="number"
                    name="earn_point" id="earn_point" value="{{ old('earn_point', '') }}" step="1">
                @if ($errors->has('earn_point'))
                    <div class="invalid-feedback">
                        {{ $errors->first('earn_point') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.orderDetail.fields.earn_point_helper') }}</span>
            </div>
            <div class="form-group col-md-3">
                <br>
                <button class="btn btn-danger" type="submit">
                    {{ trans('global.save') }}
                </button>
            </div>
        </div>
    </form>
@endcan

<div class="card">
    <div class="card-body">
        <div class="table-responsive">
            <table class=" table table-bordered table-striped table-hover datatable datatable-orderOrderDetails">
                <thead>
                    <tr>
                        <th width="10">

                        </th>
                        <th>
                            {{ trans('cruds.orderDetail.fields.id') }}
                        </th>
                        <th>
                            {{ trans('cruds.orderDetail.fields.product') }}
                        </th>
                        <th>
                            {{ trans('cruds.orderDetail.fields.price') }}
                        </th>
                        <th>
                            {{ trans('cruds.orderDetail.fields.note') }}
                        </th>
                        <th>
                            {{ trans('cruds.orderDetail.fields.variation') }}
                        </th>
                        <th>
                            {{ trans('cruds.orderDetail.fields.quantity') }}
                        </th>
                        <th>
                            {{ trans('cruds.orderDetail.fields.earn_point') }}
                        </th>
                        <th>
                            &nbsp;
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($orderDetails as $key => $orderDetail)
                        <tr data-entry-id="{{ $orderDetail->id }}">
                            <td>

                            </td>
                            <td>
                                {{ $orderDetail->id ?? '' }}
                            </td>
                            <td>
                                {{ $orderDetail->product->name ?? '' }}
                            </td>
                            <td>
                                {{ $orderDetail->price ?? '' }}
                            </td>
                            <td>
                                {{ $orderDetail->note ?? '' }}
                            </td>
                            <td>
                                {{ $orderDetail->variation ?? '' }}
                            </td>
                            <td>
                                {{ $orderDetail->quantity ?? '' }}
                            </td>
                            <td>
                                {{ $orderDetail->earn_point ?? '' }}
                            </td>
                            <td>

                                @can('order_detail_edit')
                                    <a class="btn btn-xs btn-info"
                                        href="{{ route('admin.order-details.edit', $orderDetail->id) }}">
                                        {{ trans('global.edit') }}
                                    </a>
                                @endcan

                                @can('order_detail_delete')
                                    <form action="{{ route('admin.order-details.destroy', $orderDetail->id) }}"
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

            $.extend(true, $.fn.dataTable.defaults, {
                orderCellsTop: true,
                order: [
                    [1, 'desc']
                ],
                pageLength: 25,
            });
            let table = $('.datatable-orderOrderDetails:not(.ajaxTable)').DataTable({
                buttons: dtButtons
            })
            $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e) {
                $($.fn.dataTable.tables(true)).DataTable()
                    .columns.adjust();
            });

        })
    </script>
@endsection
