@extends('layouts.admin')
@section('content')
    <div class="row">
        <div class="col-md-4">
            <div class="card">
                <div class="card-header">
                    {{ trans('global.show') }} {{ trans('cruds.store.title') }}
                </div>

                <div class="card-body">
                    <div class="form-group">
                        <div class="form-group">
                            <a class="btn btn-default" href="{{ route('admin.stores.index') }}">
                                {{ trans('global.back_to_list') }}
                            </a>
                        </div>
                        <table class="table table-bordered table-striped">
                            <tbody>
                                <tr>
                                    <th>
                                        {{ trans('cruds.store.fields.id') }}
                                    </th>
                                    <td>
                                        {{ $store->id }}
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
                                        {{ trans('cruds.store.fields.store_type') }}
                                    </th>
                                    <td>
                                        {{ App\Models\Store::STORE_TYPE_SELECT[$store->store_type] ?? '' }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.store.fields.store_name') }}
                                    </th>
                                    <td>
                                        {{ $store->store_name }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.store.fields.logo') }}
                                    </th>
                                    <td>
                                        @if ($store->logo)
                                            <a href="{{ $store->logo->getUrl() }}" target="_blank"
                                                style="display: inline-block">
                                                <img src="{{ $store->logo->getUrl('thumb') }}">
                                            </a>
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.store.fields.description') }}
                                    </th>
                                    <td>
                                        {{ $store->description }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.store.fields.city') }}
                                    </th>
                                    <td>
                                        {{ $store->city->name ?? '' }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.store.fields.address') }}
                                    </th>
                                    <td>
                                        {{ $store->address }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.store.fields.store_phone') }}
                                    </th>
                                    <td>
                                        {{ $store->store_phone }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.store.fields.store_email') }}
                                    </th>
                                    <td>
                                        {{ $store->store_email }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.store.fields.domain') }}
                                    </th>
                                    <td>
                                        {{ $store->domain }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.store.fields.commercial_register') }}
                                    </th>
                                    <td>
                                        @if ($store->commercial_register)
                                            <a href="{{ $store->commercial_register->getUrl() }}" target="_blank">
                                                {{ trans('global.view_file') }}
                                            </a>
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.store.fields.categories') }}
                                    </th>
                                    <td>
                                        @foreach ($store->categories as $key => $categories)
                                            <span class="label label-info">{{ $categories->name }}</span>
                                        @endforeach
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.store.fields.identity_num') }}
                                    </th>
                                    <td>
                                        {{ $store->identity_num }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.store.fields.commerical_register_num') }}
                                    </th>
                                    <td>
                                        {{ $store->commerical_register_num }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.store.fields.tax_number') }}
                                    </th>
                                    <td>
                                        {{ $store->tax_number }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.store.fields.rating') }}
                                    </th>
                                    <td>
                                        {{ $store->rating }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.store.fields.admin_to_pay') }}
                                    </th>
                                    <td>
                                        {{ $store->admin_to_pay }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.store.fields.store_location') }}
                                    </th>
                                    <td>
                                        
                                        <a target="_blank" href="https://www.google.com/maps?q={{ $store->latitude }},{{ $store->longitude }}">View on Map</a>
                                    </td>
                                </tr> 
                            </tbody>
                        </table>
                        <div class="form-group">
                            <a class="btn btn-default" href="{{ route('admin.stores.index') }}">
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
                        <a class="nav-link active" href="#store_orders" role="tab" data-toggle="tab">
                            {{ trans('cruds.order.title') }}
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#store_special_orders" role="tab" data-toggle="tab">
                            {{ trans('cruds.specialOrder.title') }}
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#store_store_withdraw_requests" role="tab" data-toggle="tab">
                            {{ trans('cruds.storeWithdrawRequest.title') }}
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#store_commission_histories" role="tab" data-toggle="tab">
                            {{ trans('cruds.commissionHistory.title') }}
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#store_store_cities" role="tab" data-toggle="tab">
                            {{ trans('cruds.storeCity.title') }}
                        </a>
                    </li>
                </ul>
                <div class="tab-content">
                    <div class="tab-pane active" role="tabpanel" id="store_orders">
                        @includeIf('admin.store.stores.relationships.storeOrders', [
                            'orders' => $store->storeOrders,
                        ])
                    </div>
                    <div class="tab-pane" role="tabpanel" id="store_special_orders">
                        @includeIf('admin.store.stores.relationships.storeSpecialOrders', [
                            'specialOrders' => $store->storeSpecialOrders,
                        ])
                    </div>
                    <div class="tab-pane" role="tabpanel" id="store_store_withdraw_requests">
                        @includeIf('admin.store.stores.relationships.storeStoreWithdrawRequests', [
                            'storeWithdrawRequests' => $store->storeStoreWithdrawRequests,
                        ])
                    </div>
                    <div class="tab-pane" role="tabpanel" id="store_commission_histories">
                        @includeIf('admin.store.stores.relationships.storeCommissionHistories', [
                            'commissionHistories' => $store->storeCommissionHistories,
                        ])
                    </div>
                    <div class="tab-pane" role="tabpanel" id="store_store_cities">
                        @includeIf('admin.store.stores.relationships.storeStoreCities', [
                            'storeCities' => $store->storeStoreCities,
                        ])
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
