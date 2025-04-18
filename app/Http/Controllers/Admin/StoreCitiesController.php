<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller; 
use App\Http\Requests\Admin\UpdateStoreCityRequest;
use App\Models\City;
use App\Models\Store;
use App\Models\StoreCity;
use Illuminate\Support\Facades\Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class StoreCitiesController extends Controller
{
    public function index(Request $request)
    {
        abort_if(Gate::denies('store_city_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = StoreCity::with(['store', 'city'])->select(sprintf('%s.*', (new StoreCity)->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate      = false;
                $editGate      = 'store_city_edit';
                $deleteGate    = false;
                $crudRoutePart = 'store-cities';

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
            $table->addColumn('store_store_name', function ($row) {
                return $row->store ? $row->store->store_name : '';
            });

            $table->addColumn('city_name', function ($row) {
                return $row->city ? $row->city->name : '';
            });

            $table->editColumn('price', function ($row) {
                return $row->price ? $row->price : '';
            });

            $table->rawColumns(['actions', 'placeholder', 'store', 'city']);

            return $table->make(true);
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
