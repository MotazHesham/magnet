<?php

namespace App\Http\Controllers\Admin\Product;

use App\Http\Controllers\Controller; 
use App\Http\Requests\Admin\StoreAttributeValueRequest;
use App\Http\Requests\Admin\UpdateAttributeValueRequest;
use App\Models\Attribute;
use App\Models\AttributeValue;
use Illuminate\Support\Facades\Gate; 
use Symfony\Component\HttpFoundation\Response; 

class AttributeValuesController extends Controller
{ 
    public function store(StoreAttributeValueRequest $request)
    {
        $attributeValue = AttributeValue::create($request->all());

        return redirect()->route('admin.attributes.show',$attributeValue->attribute_id);
    }

    public function edit(AttributeValue $attributeValue)
    {
        abort_if(Gate::denies('attribute_value_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $attributes = Attribute::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $attributeValue->load('attribute');

        return view('admin.product.attributeValues.edit', compact('attributeValue', 'attributes'));
    }

    public function update(UpdateAttributeValueRequest $request, AttributeValue $attributeValue)
    {
        $attributeValue->update($request->all());

        return redirect()->route('admin.attributes.show',$attributeValue->attribute_id);
    } 

    public function destroy(AttributeValue $attributeValue)
    {
        abort_if(Gate::denies('attribute_value_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $attributeValue->delete();

        return back();
    } 
}
