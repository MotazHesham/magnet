<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller; 
use App\Models\Address; 
use Illuminate\Support\Facades\Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class AddressController extends Controller
{
    public function index(Request $request)
    {
        abort_if(Gate::denies('address_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = Address::with(['user', 'region', 'city', 'district'])->select(sprintf('%s.*', (new Address)->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate      = 'address_show';
                $editGate      = false;
                $deleteGate    = false;
                $crudRoutePart = 'addresses';

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
            $table->addColumn('user_name', function ($row) {
                return $row->user ? $row->user->name : '';
            });

            $table->editColumn('name', function ($row) {
                return $row->name ? $row->name : '';
            });
            $table->addColumn('region_name', function ($row) {
                return $row->region ? $row->region->name : '';
            });

            $table->addColumn('city_name', function ($row) {
                return $row->city ? $row->city->name : '';
            });

            $table->addColumn('district_name', function ($row) {
                return $row->district ? $row->district->name : '';
            });

            $table->editColumn('address', function ($row) {
                return $row->address ? $row->address : '';
            });
            $table->editColumn('is_default', function ($row) {
                return '<input type="checkbox" disabled ' . ($row->is_default ? 'checked' : null) . '>';
            });

            $table->rawColumns(['actions', 'placeholder', 'user', 'region', 'city', 'district', 'is_default']);

            return $table->make(true);
        }

        return view('admin.addresses.index');
    } 

    public function show(Address $address)
    {
        abort_if(Gate::denies('address_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $address->load('user', 'region', 'city', 'district');

        return view('admin.addresses.show', compact('address'));
    } 
}
