<?php

namespace App\Http\Controllers\Admin\Store;

use App\Http\Controllers\Controller; 
use App\Http\Requests\Admin\UpdateStoreCityRequest;
use App\Models\City;
use App\Models\Store;
use App\Models\StoreCity;
use App\Utils\DataTableHandler;
use Illuminate\Support\Facades\Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response; 

class StoreCitiesController extends Controller
{
    public function index(Request $request)
    {
        abort_if(Gate::denies('store_city_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $config = [
                'relations' => ['store', 'city'],
                'columns' => [
                    'store_store_name' => function ($row) {
                        return $row->store ? $row->store->store_name : '';
                    },
                    'city_name' => function ($row) {
                        return $row->city ? $row->city->name : '';
                    },
                ],
                'gates' => [
                    'view' => false,
                    'edit' => 'store_city_edit',
                    'delete' => false
                ],
                'crudRoutePart' => 'store-cities'
            ];

            $handler = new DataTableHandler(new StoreCity(), $config);
            return $handler->handle($request);  
        }

        return view('admin.store.storeCities.index');
    } 

    public function edit(StoreCity $storeCity)
    {
        abort_if(Gate::denies('store_city_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $stores = Store::pluck('store_name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $cities = City::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $storeCity->load('store', 'city');

        return view('admin.store.storeCities.edit', compact('cities', 'storeCity', 'stores'));
    }

    public function update(UpdateStoreCityRequest $request, StoreCity $storeCity)
    {
        $storeCity->update($request->all());

        return redirect()->route('admin.store-cities.index');
    } 
}
