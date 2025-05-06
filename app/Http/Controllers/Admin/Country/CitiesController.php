<?php

namespace App\Http\Controllers\Admin\Country;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\MassDestroyCityRequest;
use App\Http\Requests\Admin\StoreCityRequest;
use App\Http\Requests\Admin\UpdateCityRequest;
use App\Models\City;
use App\Models\District;
use App\Utils\DataTableHandler;
use Illuminate\Support\Facades\Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CitiesController extends Controller
{
    public function index(Request $request)
    {
        abort_if(Gate::denies('city_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $config = [
                'relations' => ['districts'],
                'columns' => [ 
                    'name' => function ($row) {
                        return $row->name ? $row->name : '';
                    },
                    'active' => [
                        'type' => 'checkbox',
                        'options' => [
                            'model' => City::class,
                        ]
                    ], 
                    'districts' => [
                        'type' => 'relation-many',
                        'options' => [
                            'column' => 'name',
                        ]
                    ]
                ],
                'gates' => [
                    'view' => 'city_show',
                    'edit' => 'city_edit',
                    'delete' => 'city_delete'
                ],
                'crudRoutePart' => 'cities',
                'rawColumns' => ['active', 'districts']
            ];

            $handler = new DataTableHandler(new City(), $config);
            return $handler->handle($request);
        }

        return view('admin.cities.index');
    }

    public function create()
    {
        abort_if(Gate::denies('city_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $districts = District::pluck('name', 'id');

        return view('admin.cities.create', compact('districts'));
    }

    public function store(StoreCityRequest $request)
    {
        $city = City::create($request->all());
        $city->districts()->sync($request->input('districts', []));

        return redirect()->route('admin.cities.index');
    }

    public function edit(City $city)
    {
        abort_if(Gate::denies('city_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $districts = District::pluck('name', 'id');

        $city->load('districts');

        return view('admin.cities.edit', compact('city', 'districts'));
    }

    public function update(UpdateCityRequest $request, City $city)
    {
        $city->update($request->all());
        $city->districts()->sync($request->input('districts', []));

        return redirect()->route('admin.cities.index');
    }

    public function show(City $city)
    {
        abort_if(Gate::denies('city_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $city->load('districts');

        return view('admin.cities.show', compact('city'));
    }

    public function destroy(City $city)
    {
        abort_if(Gate::denies('city_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $city->delete();

        return back();
    }

    public function massDestroy(MassDestroyCityRequest $request)
    {
        $cities = City::find(request('ids'));

        foreach ($cities as $city) {
            $city->delete();
        }

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
