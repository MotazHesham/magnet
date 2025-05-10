@can($viewGate)
    <a class="btn btn-sm btn-icon btn-primary-light" href="{{ route('admin.' . $crudRoutePart . '.show', $row->id) }}">
        <i class="ri-eye-line"></i>
    </a>
@endcan
@can($editGate)
    <a class="btn btn-sm btn-icon btn-info-light" href="{{ route('admin.' . $crudRoutePart . '.edit', $row->id) }}">
        <i class="ri-edit-line"></i>
    </a>
@endcan
@can($deleteGate)
    <form action="{{ route('admin.' . $crudRoutePart . '.destroy', $row->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
        <input type="hidden" name="_method" value="DELETE">
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
        <button type="submit" class="btn btn-sm btn-icon btn-danger-light">
            <i class="ri-delete-bin-line"></i>
        </button>
    </form>
@endcan