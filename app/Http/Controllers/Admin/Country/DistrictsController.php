<?php

namespace App\Http\Controllers\Admin\Country;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\MassDestroyDistrictRequest;
use App\Http\Requests\Admin\StoreDistrictRequest;
use App\Http\Requests\Admin\UpdateDistrictRequest;
use App\Models\District;
use Illuminate\Support\Facades\Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Utils\DataTableHandler;

class DistrictsController extends Controller
{
    public function index(Request $request)
    {
        abort_if(Gate::denies('district_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $config = [
                'columns' => [ 
                    'name' => function ($row) {
                        return $row->name ? $row->name : '';
                    },
                    'active' => [
                        'type' => 'checkbox',
                        'options' => [
                            'model' => District::class,
                        ]
                    ]
                ],
                'gates' => [
                    'view' => 'district_show',
                    'edit' => 'district_edit', 
                    'delete' => 'district_delete'
                ],
                'crudRoutePart' => 'districts',
                'rawColumns' => ['active']
            ];

            $handler = new DataTableHandler(new District(), $config);
            return $handler->handle($request);
        }

        return view('admin.districts.index');
    }

    public function create()
    {
        abort_if(Gate::denies('district_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.districts.create');
    }

    public function store(StoreDistrictRequest $request)
    {
        $district = District::create($request->all());

        return redirect()->route('admin.districts.index');
    }

    public function edit(District $district)
    {
        abort_if(Gate::denies('district_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.districts.edit', compact('district'));
    }

    public function update(UpdateDistrictRequest $request, District $district)
    {
        $district->update($request->all());

        return redirect()->route('admin.districts.index');
    }

    public function show(District $district)
    {
        abort_if(Gate::denies('district_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.districts.show', compact('district'));
    }

    public function destroy(District $district)
    {
        abort_if(Gate::denies('district_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $district->delete();

        return back();
    }

    public function massDestroy(MassDestroyDistrictRequest $request)
    {
        $districts = District::find(request('ids'));

        foreach ($districts as $district) {
            $district->delete();
        }

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
