<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller; 
use App\Http\Requests\Admin\StoreAttributeRequest;
use App\Http\Requests\Admin\UpdateAttributeRequest;
use App\Models\Attribute;
use Illuminate\Support\Facades\Gate; 
use Symfony\Component\HttpFoundation\Response;

class AttributesController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('attribute_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $attributes = Attribute::with('attributeAttributeValues')->paginate();

        return view('admin.product.attributes.index', compact('attributes'));
    } 

    public function store(StoreAttributeRequest $request)
    {
        $attribute = Attribute::create($request->all());

        return redirect()->route('admin.attributes.index');
    }

    public function edit(Attribute $attribute)
    {
        abort_if(Gate::denies('attribute_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.product.attributes.edit', compact('attribute'));
    }

    public function update(UpdateAttributeRequest $request, Attribute $attribute)
    {
        $attribute->setTranslation('name',$request->lang,$request->name);
        $attribute->save();
        
        return redirect()->route('admin.attributes.index');
    }

    public function show(Attribute $attribute)
    {
        abort_if(Gate::denies('attribute_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $attribute->load('attributeAttributeValues');

        return view('admin.product.attributes.show', compact('attribute'));
    }

    public function destroy(Attribute $attribute)
    {
        abort_if(Gate::denies('attribute_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $attribute->delete();

        return back();
    } 
}
