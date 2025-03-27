@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.productReview.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.product-reviews.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.productReview.fields.id') }}
                        </th>
                        <td>
                            {{ $productReview->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.productReview.fields.rate') }}
                        </th>
                        <td>
                            {{ $productReview->rate }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.productReview.fields.review') }}
                        </th>
                        <td>
                            {{ $productReview->review }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.productReview.fields.product') }}
                        </th>
                        <td>
                            {{ $productReview->product->name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.productReview.fields.user') }}
                        </th>
                        <td>
                            {{ $productReview->user->name ?? '' }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.product-reviews.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection