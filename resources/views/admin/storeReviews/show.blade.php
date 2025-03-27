@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.storeReview.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.store-reviews.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.storeReview.fields.id') }}
                        </th>
                        <td>
                            {{ $storeReview->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.storeReview.fields.store') }}
                        </th>
                        <td>
                            {{ $storeReview->store->store_name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.storeReview.fields.user') }}
                        </th>
                        <td>
                            {{ $storeReview->user->name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.storeReview.fields.rate') }}
                        </th>
                        <td>
                            {{ $storeReview->rate }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.storeReview.fields.review') }}
                        </th>
                        <td>
                            {{ $storeReview->review }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.store-reviews.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection