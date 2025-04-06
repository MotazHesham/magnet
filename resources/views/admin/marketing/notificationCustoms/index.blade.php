@extends('layouts.admin')
@section('content')
    @can('notification_custom_create')
        <div style="margin-bottom: 10px;" class="row">
            <div class="col-lg-12">
                <a class="btn btn-success" href="{{ route('admin.notification-customs.create') }}">
                    {{ trans('global.add') }} {{ trans('cruds.notificationCustom.title_singular') }}
                </a>
            </div>
        </div>
    @endcan
    <div class="card">
        <div class="card-header">
            {{ trans('cruds.notificationCustom.title_singular') }} {{ trans('global.list') }}
        </div>

        <div class="card-body">
            <div class="table-responsive">
                <table class=" table table-bordered table-striped table-hover datatable datatable-NotificationCustom">
                    <thead>
                        <tr>
                            <th width="10">

                            </th>
                            <th>
                                {{ trans('cruds.notificationCustom.fields.id') }}
                            </th>
                            <th>
                                {{ trans('cruds.notificationCustom.fields.notification_type') }}
                            </th>
                            <th>
                                {{ trans('cruds.notificationCustom.fields.title') }}
                            </th>
                            <th>
                                {{ trans('cruds.notificationCustom.fields.description') }}
                            </th>
                            <th>
                                {{ trans('cruds.notificationCustom.fields.link') }}
                            </th>
                            <th>
                                {{ trans('cruds.notificationCustom.fields.created_at') }}
                            </th>
                            <th>
                                &nbsp;
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($notificationCustoms as $key => $notificationCustom)
                            <tr data-entry-id="{{ $notificationCustom->id }}">
                                <td>

                                </td>
                                <td>
                                    {{ $notificationCustom->id ?? '' }}
                                </td>
                                <td>
                                    {{ $notificationCustom->notification_type->name ?? '' }}
                                </td>
                                <td>
                                    {{ $notificationCustom->title ?? '' }}
                                </td>
                                <td>
                                    {{ $notificationCustom->description ?? '' }}
                                </td>
                                <td>
                                    {{ $notificationCustom->link ?? '' }}
                                </td>
                                <td>
                                    {{ $notificationCustom->created_at ?? '' }}
                                </td>
                                <td>
                                    @can('notification_custom_show')
                                        <a class="btn btn-xs btn-primary"
                                            href="{{ route('admin.notification-customs.show', $notificationCustom->id) }}">
                                            {{ trans('global.view') }}
                                        </a>
                                    @endcan

                                    @can('notification_custom_edit')
                                        <a class="btn btn-xs btn-info"
                                            href="{{ route('admin.notification-customs.edit', $notificationCustom->id) }}">
                                            {{ trans('global.edit') }}
                                        </a>
                                    @endcan

                                    @can('notification_custom_delete')
                                        <form
                                            action="{{ route('admin.notification-customs.destroy', $notificationCustom->id) }}"
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
@endsection
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
            let table = $('.datatable-NotificationCustom:not(.ajaxTable)').DataTable({
                buttons: dtButtons
            })
            $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e) {
                $($.fn.dataTable.tables(true)).DataTable()
                    .columns.adjust();
            });

        })
    </script>
@endsection
