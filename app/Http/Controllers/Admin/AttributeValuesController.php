<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\MassDestroyAttributeValueRequest;
use App\Http\Requests\Admin\StoreAttributeValueRequest;
use App\Http\Requests\Admin\UpdateAttributeValueRequest;
use App\Models\Attribute;
use App\Models\AttributeValue;
use Illuminate\Support\Facades\Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class AttributeValuesController extends Controller
{
    public function index(Request $request)
    {
        abort_if(Gate::denies('attribute_value_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = AttributeValue::with(['attribute'])->select(sprintf('%s.*', (new AttributeValue)->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate      = 'attribute_value_show';
                $editGate      = 'attribute_value_edit';
                $deleteGate    = 'attribute_value_delete';
                $crudRoutePart = 'attribute-values';

                return view('partials.datatablesActions', compact(
                    'viewGate',
                    'editGate',
                    'deleteGate',
                    'crudRoutePart',
                    'row'
                ));
            });

            $table->editColumn('id', function ($row) {
                return $row->id ? $row->id : '';
            });
            $table->addColumn('attribute_name', function ($row) {
                return $row->attribute ? $row->attribute->name : '';
            });

            $table->editColumn('value', function ($row) {
                return $row->value ? $row->value : '';
            });

            $table->rawColumns(['actions', 'placeholder', 'attribute']);

            return $table->make(true);
        }

        return view('admin.attributeValues.index');
    }

    public function create()
    {
        abort_if(Gate::denies('attribute_value_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $attributes = Attribute::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.attributeValues.create', compact('attributes'));
    }

    public function store(StoreAttributeValueRequest $request)
    {
        $attributeValue = AttributeValue::create($request->all());

        return redirect()->route('admin.attribute-values.index');
    }

    public function edit(AttributeValue $attributeValue)
    {
        abort_if(Gate::denies('attribute_value_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $attributes = Attribute::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $attributeValue->load('attribute');

        return view('admin.attributeValues.edit', compact('attributeValue', 'attributes'));
    }

    public function update(UpdateAttributeValueRequest $request, AttributeValue $attributeValue)
    {
        $attributeValue->update($request->all());

        return redirect()->route('admin.attribute-values.index');
    }

    public function show(AttributeValue $attributeValue)
    {
        abort_if(Gate::denies('attribute_value_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $attributeValue->load('attribute');

        return view('admin.attributeValues.show', compact('attributeValue'));
    }

    public function destroy(AttributeValue $attributeValue)
    {
        abort_if(Gate::denies('attribute_value_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $attributeValue->delete();

        return back();
    }

    public function massDestroy(MassDestroyAttributeValueRequest $request)
    {
        $attributeValues = AttributeValue::find(request('ids'));

        foreach ($attributeValues as $attributeValue) {
            $attributeValue->delete();
        }

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
