<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\MassDestroyStoreFollowerRequest;
use App\Http\Requests\Admin\StoreStoreFollowerRequest;
use App\Http\Requests\Admin\UpdateStoreFollowerRequest;
use App\Models\Store;
use App\Models\StoreFollower;
use App\Models\User;
use Illuminate\Support\Facades\Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class StoreFollowersController extends Controller
{
    public function index(Request $request)
    {
        abort_if(Gate::denies('store_follower_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = StoreFollower::with(['store', 'user'])->select(sprintf('%s.*', (new StoreFollower)->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate      = 'store_follower_show';
                $editGate      = 'store_follower_edit';
                $deleteGate    = 'store_follower_delete';
                $crudRoutePart = 'store-followers';

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

            $table->addColumn('user_name', function ($row) {
                return $row->user ? $row->user->name : '';
            });

            $table->rawColumns(['actions', 'placeholder', 'store', 'user']);

            return $table->make(true);
        }

        return view('admin.storeFollowers.index');
    }

    public function create()
    {
        abort_if(Gate::denies('store_follower_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $stores = Store::pluck('store_name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $users = User::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.storeFollowers.create', compact('stores', 'users'));
    }

    public function store(StoreStoreFollowerRequest $request)
    {
        $storeFollower = StoreFollower::create($request->all());

        return redirect()->route('admin.store-followers.index');
    }

    public function edit(StoreFollower $storeFollower)
    {
        abort_if(Gate::denies('store_follower_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $stores = Store::pluck('store_name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $users = User::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $storeFollower->load('store', 'user');

        return view('admin.storeFollowers.edit', compact('storeFollower', 'stores', 'users'));
    }

    public function update(UpdateStoreFollowerRequest $request, StoreFollower $storeFollower)
    {
        $storeFollower->update($request->all());

        return redirect()->route('admin.store-followers.index');
    }

    public function show(StoreFollower $storeFollower)
    {
        abort_if(Gate::denies('store_follower_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $storeFollower->load('store', 'user');

        return view('admin.storeFollowers.show', compact('storeFollower'));
    }

    public function destroy(StoreFollower $storeFollower)
    {
        abort_if(Gate::denies('store_follower_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $storeFollower->delete();

        return back();
    }

    public function massDestroy(MassDestroyStoreFollowerRequest $request)
    {
        $storeFollowers = StoreFollower::find(request('ids'));

        foreach ($storeFollowers as $storeFollower) {
            $storeFollower->delete();
        }

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
