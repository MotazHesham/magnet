@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.user.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.users.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.user.fields.id') }}
                        </th>
                        <td>
                            {{ $user->id }}
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
                            {{ trans('cruds.user.fields.email_verified_at') }}
                        </th>
                        <td>
                            {{ $user->email_verified_at }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.user.fields.approved') }}
                        </th>
                        <td>
                            <input type="checkbox" disabled="disabled" {{ $user->approved ? 'checked' : '' }}>
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.user.fields.verified') }}
                        </th>
                        <td>
                            <input type="checkbox" disabled="disabled" {{ $user->verified ? 'checked' : '' }}>
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.user.fields.roles') }}
                        </th>
                        <td>
                            @foreach($user->roles as $key => $roles)
                                <span class="label label-info">{{ $roles->title }}</span>
                            @endforeach
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
                            @if($user->photo)
                                <a href="{{ $user->photo->getUrl() }}" target="_blank" style="display: inline-block">
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
                    <tr>
                        <th>
                            {{ trans('cruds.user.fields.city') }}
                        </th>
                        <td>
                            {{ $user->city->name ?? '' }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.users.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>

<div class="card">
    <div class="card-header">
        {{ trans('global.relatedData') }}
    </div>
    <ul class="nav nav-tabs" role="tablist" id="relationship-tabs">
        <li class="nav-item">
            <a class="nav-link" href="#user_product_reviews" role="tab" data-toggle="tab">
                {{ trans('cruds.productReview.title') }}
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#user_addresses" role="tab" data-toggle="tab">
                {{ trans('cruds.address.title') }}
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#user_customers" role="tab" data-toggle="tab">
                {{ trans('cruds.customer.title') }}
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#user_customer_points" role="tab" data-toggle="tab">
                {{ trans('cruds.customerPoint.title') }}
            </a>
        </li>
    </ul>
    <div class="tab-content">
        <div class="tab-pane" role="tabpanel" id="user_product_reviews">
            @includeIf('admin.users.relationships.userProductReviews', ['productReviews' => $user->userProductReviews])
        </div>
        <div class="tab-pane" role="tabpanel" id="user_addresses">
            @includeIf('admin.users.relationships.userAddresses', ['addresses' => $user->userAddresses])
        </div>
        <div class="tab-pane" role="tabpanel" id="user_customers">
            @includeIf('admin.users.relationships.userCustomers', ['customers' => $user->userCustomers])
        </div>
        <div class="tab-pane" role="tabpanel" id="user_customer_points">
            @includeIf('admin.users.relationships.userCustomerPoints', ['customerPoints' => $user->userCustomerPoints])
        </div>
    </div>
</div>

@endsection