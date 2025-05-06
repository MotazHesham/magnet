<?php

namespace App\Http\Controllers\Admin\Country;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\MassDestroyRegionRequest;
use App\Http\Requests\Admin\StoreRegionRequest;
use App\Http\Requests\Admin\UpdateRegionRequest;
use App\Models\City;
use App\Models\Region;
use Illuminate\Support\Facades\Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Utils\DataTableHandler;

class RegionsController extends Controller
{
    public function index(Request $request)
    {
        abort_if(Gate::denies('region_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        if ($request->ajax()) {
            $config = [
                'relations' => ['cities'],
                'columns' => [ 
                    'name' => function ($row) {
                        return $row->name ? $row->name : '';
                    },
                    'cities' => [
                        'type' => 'relation-many',
                        'options' => [
                            'column' => 'name',
                        ]
                    ]
                ],
                'gates' => [
                    'view' => 'region_show',
                    'edit' => 'region_edit',
                    'delete' => 'region_delete'
                ],
                'crudRoutePart' => 'regions',
                'rawColumns' => ['cities']
            ];

            $handler = new DataTableHandler(new Region(), $config);
            return $handler->handle($request);
        }

        return view('admin.regions.index');
    }

    public function create()
    {
        abort_if(Gate::denies('region_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $cities = City::pluck('name', 'id');

        return view('admin.regions.create', compact('cities'));
    }

    public function store(StoreRegionRequest $request)
    {
        $region = Region::create($request->all());
        $region->cities()->sync($request->input('cities', []));

        return redirect()->route('admin.regions.index');
    }

    public function edit(Region $region)
    {
        abort_if(Gate::denies('region_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $cities = City::pluck('name', 'id');

        $region->load('cities');

        return view('admin.regions.edit', compact('cities', 'region'));
    }

    public function update(UpdateRegionRequest $request, Region $region)
    {
        $region->update($request->all());
        $region->cities()->sync($request->input('cities', []));

        return redirect()->route('admin.regions.index');
    }

    public function show(Region $region)
    {
        abort_if(Gate::denies('region_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $region->load('cities');

        return view('admin.regions.show', compact('region'));
    }

    public function destroy(Region $region)
    {
        abort_if(Gate::denies('region_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $region->delete();

        return back();
    }

    public function massDestroy(MassDestroyRegionRequest $request)
    {
        $regions = Region::find(request('ids'));

        foreach ($regions as $region) {
            $region->delete();
        }

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
