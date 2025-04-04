@extends('layouts.admin')
@section('content')
    <div class="row">
        <div class="col-md-4">
            <div class="card">
                <div class="card-header">
                    {{ trans('global.show') }} {{ trans('cruds.customer.title') }}
                </div>

                <div class="card-body">
                    <div class="form-group">
                        <div class="form-group">
                            <a class="btn btn-default" href="{{ route('admin.customers.index') }}">
                                {{ trans('global.back_to_list') }}
                            </a>
                        </div>
                        <table class="table table-bordered table-striped">
                            <tbody>
                                <tr>
                                    <th>
                                        {{ trans('cruds.customer.fields.id') }}
                                    </th>
                                    <td>
                                        {{ $customer->id }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.customer.fields.user') }}
                                    </th>
                                    <td>
                                        {{ $customer->user->name ?? '' }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.customer.fields.wallet_balance') }}
                                    </th>
                                    <td>
                                        {{ $customer->wallet_balance }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.customer.fields.points') }}
                                    </th>
                                    <td>
                                        {{ $customer->points }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.customer.fields.can_scratch') }}
                                    </th>
                                    <td>
                                        <input type="checkbox" disabled="disabled"
                                            {{ $customer->can_scratch ? 'checked' : '' }}>
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.user.fields.name') }}
                                    </th>
                                    <td>
                                        {{ $user->name }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.user.fields.email') }}
                                    </th>
                                    <td>
                                        {{ $user->email }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.user.fields.phone') }}
                                    </th>
                                    <td>
                                        {{ $user->phone }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.user.fields.photo') }}
                                    </th>
                                    <td>
                                        @if ($user->photo)
                                            <a href="{{ $user->photo->getUrl() }}" target="_blank"
                                                style="display: inline-block">
                                                <img src="{{ $user->photo->getUrl('thumb') }}">
                                            </a>
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.user.fields.block') }}
                                    </th>
                                    <td>
                                        <input type="checkbox" disabled="disabled" {{ $user->block ? 'checked' : '' }}>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <div class="form-group">
                            <a class="btn btn-default" href="{{ route('admin.customers.index') }}">
                                {{ trans('global.back_to_list') }}
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    {{ trans('global.relatedData') }}
                </div>
                <ul class="nav nav-tabs" role="tablist" id="relationship-tabs">
                    <li class="nav-item">
                        <a class="nav-link active" href="#user_addresses" role="tab" data-toggle="tab">
                            {{ trans('cruds.address.title') }}
                        </a>
                    </li> 
                    <li class="nav-item">
                        <a class="nav-link" href="#user_product_reviews" role="tab" data-toggle="tab">
                            {{ trans('cruds.productReview.title') }}
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#user_customer_points" role="tab" data-toggle="tab">
                            {{ trans('cruds.customerPoint.title') }}
                        </a>
                    </li>
                </ul>
                <div class="tab-content">
                    <div class="tab-pane active" role="tabpanel" id="user_addresses">
                        @includeIf('admin.users.relationships.userAddresses', [
                            'addresses' => $user->userAddresses,
                        ])
                    </div> 
                    <div class="tab-pane" role="tabpanel" id="user_product_reviews">
                        @includeIf('admin.users.relationships.userProductReviews', [
                            'productReviews' => $user->userProductReviews,
                        ])
                    </div>
                    <div class="tab-pane" role="tabpanel" id="user_customer_points">
                        @includeIf('admin.users.relationships.userCustomerPoints', [
                            'customerPoints' => $user->userCustomerPoints,
                        ])
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
