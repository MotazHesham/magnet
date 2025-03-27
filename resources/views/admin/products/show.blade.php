@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.product.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.products.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.product.fields.id') }}
                        </th>
                        <td>
                            {{ $product->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.product.fields.store') }}
                        </th>
                        <td>
                            {{ $product->store->store_name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.product.fields.name') }}
                        </th>
                        <td>
                            {{ $product->name }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.product.fields.product_categories') }}
                        </th>
                        <td>
                            @foreach($product->product_categories as $key => $product_categories)
                                <span class="label label-info">{{ $product_categories->name }}</span>
                            @endforeach
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.product.fields.brand') }}
                        </th>
                        <td>
                            {{ $product->brand->name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.product.fields.weight') }}
                        </th>
                        <td>
                            {{ $product->weight }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.product.fields.tags') }}
                        </th>
                        <td>
                            {{ $product->tags }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.product.fields.description') }}
                        </th>
                        <td>
                            {!! $product->description !!}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.product.fields.refundable') }}
                        </th>
                        <td>
                            <input type="checkbox" disabled="disabled" {{ $product->refundable ? 'checked' : '' }}>
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.product.fields.featured') }}
                        </th>
                        <td>
                            <input type="checkbox" disabled="disabled" {{ $product->featured ? 'checked' : '' }}>
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.product.fields.approved') }}
                        </th>
                        <td>
                            <input type="checkbox" disabled="disabled" {{ $product->approved ? 'checked' : '' }}>
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.product.fields.published') }}
                        </th>
                        <td>
                            <input type="checkbox" disabled="disabled" {{ $product->published ? 'checked' : '' }}>
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.product.fields.main_photo') }}
                        </th>
                        <td>
                            @if($product->main_photo)
                                <a href="{{ $product->main_photo->getUrl() }}" target="_blank" style="display: inline-block">
                                    <img src="{{ $product->main_photo->getUrl('thumb') }}">
                                </a>
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.product.fields.photos') }}
                        </th>
                        <td>
                            @foreach($product->photos as $key => $media)
                                <a href="{{ $media->getUrl() }}" target="_blank" style="display: inline-block">
                                    <img src="{{ $media->getUrl('thumb') }}">
                                </a>
                            @endforeach
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.product.fields.video_provider') }}
                        </th>
                        <td>
                            {{ App\Models\Product::VIDEO_PROVIDER_SELECT[$product->video_provider] ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.product.fields.video_link') }}
                        </th>
                        <td>
                            {{ $product->video_link }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.product.fields.price') }}
                        </th>
                        <td>
                            {{ $product->price }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.product.fields.shipping_cost') }}
                        </th>
                        <td>
                            {{ $product->shipping_cost }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.product.fields.discount') }}
                        </th>
                        <td>
                            {{ $product->discount }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.product.fields.discount_type') }}
                        </th>
                        <td>
                            {{ App\Models\Product::DISCOUNT_TYPE_SELECT[$product->discount_type] ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.product.fields.current_stock') }}
                        </th>
                        <td>
                            {{ $product->current_stock }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.product.fields.sku') }}
                        </th>
                        <td>
                            {{ $product->sku }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.product.fields.variant_product') }}
                        </th>
                        <td>
                            <input type="checkbox" disabled="disabled" {{ $product->variant_product ? 'checked' : '' }}>
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.product.fields.attibutes') }}
                        </th>
                        <td>
                            {{ $product->attibutes }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.product.fields.choice_options') }}
                        </th>
                        <td>
                            {{ $product->choice_options }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.product.fields.colors') }}
                        </th>
                        <td>
                            {{ $product->colors }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.product.fields.variations') }}
                        </th>
                        <td>
                            {{ $product->variations }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.product.fields.est_shipping_days') }}
                        </th>
                        <td>
                            {{ $product->est_shipping_days }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.product.fields.num_of_sale') }}
                        </th>
                        <td>
                            {{ $product->num_of_sale }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.product.fields.rating') }}
                        </th>
                        <td>
                            {{ $product->rating }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.product.fields.slug') }}
                        </th>
                        <td>
                            {{ $product->slug }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.product.fields.meta_title') }}
                        </th>
                        <td>
                            {{ $product->meta_title }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.product.fields.meta_description') }}
                        </th>
                        <td>
                            {{ $product->meta_description }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.products.index') }}">
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
            <a class="nav-link" href="#product_product_reviews" role="tab" data-toggle="tab">
                {{ trans('cruds.productReview.title') }}
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#product_product_complaints" role="tab" data-toggle="tab">
                {{ trans('cruds.productComplaint.title') }}
            </a>
        </li>
    </ul>
    <div class="tab-content">
        <div class="tab-pane" role="tabpanel" id="product_product_reviews">
            @includeIf('admin.products.relationships.productProductReviews', ['productReviews' => $product->productProductReviews])
        </div>
        <div class="tab-pane" role="tabpanel" id="product_product_complaints">
            @includeIf('admin.products.relationships.productProductComplaints', ['productComplaints' => $product->productProductComplaints])
        </div>
    </div>
</div>

@endsection