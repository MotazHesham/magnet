<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\Admin\MassDestroyStoreRequest;
use App\Http\Requests\Admin\StoreStoreRequest;
use App\Http\Requests\Admin\UpdateStoreRequest;
use App\Models\City;
use App\Models\ProductCategory;
use App\Models\Store; 
use App\Models\User;
use Illuminate\Support\Facades\Gate;
use Illuminate\Http\Request;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class StoresController extends Controller
{
    use MediaUploadingTrait;

    public function index(Request $request)
    {
        abort_if(Gate::denies('store_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = Store::with(['user', 'city'])->select(sprintf('%s.*', (new Store)->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate      = 'store_show';
                $editGate      = 'store_edit';
                $deleteGate    = 'store_delete';
                $crudRoutePart = 'stores';

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
            $table->editColumn('store_type', function ($row) {
                return $row->store_type ? Store::STORE_TYPE_SELECT[$row->store_type] : '';
            });
            $table->editColumn('store_name', function ($row) {
                return $row->store_name ? $row->store_name : '';
            });
            $table->editColumn('logo', function ($row) {
                if ($photo = $row->logo) {
                    return sprintf(
                        '<a href="%s" target="_blank"><img src="%s" width="50px" height="50px"></a>',
                        $photo->url,
                        $photo->thumbnail
                    );
                }

                return '';
            });
            $table->addColumn('city_name', function ($row) {
                return $row->city ? $row->city->name : '';
            });

            $table->editColumn('store_phone', function ($row) {
                return $row->store_phone ? $row->store_phone : '';
            });
            $table->editColumn('domain', function ($row) {
                return $row->domain ? $row->domain : '';
            });
            $table->editColumn('rating', function ($row) {
                return $row->rating ? $row->rating : '';
            });
            $table->editColumn('admin_to_pay', function ($row) {
                return $row->admin_to_pay ? $row->admin_to_pay : '';
            });

            $table->rawColumns(['actions', 'placeholder', 'logo', 'city']);

            return $table->make(true);
        }

        return view('admin.store.stores.index');
    }

    public function create()
    {
        abort_if(Gate::denies('store_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $users = User::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $cities = City::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $categories = ProductCategory::pluck('name', 'id');

        return view('admin.store.stores.create', compact('categories', 'cities', 'users'));
    }

    public function store(StoreStoreRequest $request)
    {
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email, 
            'password' => $request->password,
            'approved' => 1,
            'user_type' => 'store',
            'phone' => $request->phone, 
        ]);

        $store = Store::create([
            'user_id' => $user->id,
            'store_type' => $request->store_type,
            'store_name' => $request->store_name,
            'description' => $request->description,
            'city_id' => $request->city_id,
            'address' => $request->address,
            'store_phone' => $request->store_phone,
            'store_email' => $request->store_email,
            'domain' => $request->domain,
            'identity_num' => $request->identity_num,
            'commerical_register_num' => $request->commerical_register_num,
            'tax_number' => $request->tax_number, 
            'latitude' => $request->latitude,
            'longitude' => $request->longitude,
        ]);

        $store->categories()->sync($request->input('categories', []));

        if ($request->input('logo', false)) {
            $store->addMedia(storage_path('tmp/uploads/' . basename($request->input('logo'))))->toMediaCollection('logo');
        }

        if ($request->input('commercial_register', false)) {
            $store->addMedia(storage_path('tmp/uploads/' . basename($request->input('commercial_register'))))->toMediaCollection('commercial_register');
        }

        if ($media = $request->input('ck-media', false)) {
            Media::whereIn('id', $media)->update(['model_id' => $store->id]);
        }

        return redirect()->route('admin.stores.index');
    }

    public function edit(Store $store)
    {
        abort_if(Gate::denies('store_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $users = User::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $cities = City::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $categories = ProductCategory::pluck('name', 'id');

        $store->load('user', 'city', 'categories');
        $user = $store->user;

        return view('admin.store.stores.edit', compact('categories', 'cities', 'store', 'user'));
    }

    public function update(UpdateStoreRequest $request, Store $store)
    {
        $user = User::findOrFail($request->user_id);

        $user->update([
            'name' => $request->name,
            'email' => $request->email, 
            'password' => $request->password, 
            'phone' => $request->phone, 
        ]);

        $store->update([ 
            'store_type' => $request->store_type,
            'store_name' => $request->store_name,
            'description' => $request->description,
            'city_id' => $request->city_id,
            'address' => $request->address,
            'store_phone' => $request->store_phone,
            'store_email' => $request->store_email,
            'domain' => $request->domain,
            'identity_num' => $request->identity_num,
            'commerical_register_num' => $request->commerical_register_num,
            'tax_number' => $request->tax_number, 
            'latitude' => $request->latitude,
            'longitude' => $request->longitude,
        ]);

        $store->categories()->sync($request->input('categories', []));

        if ($request->input('logo', false)) {
            if (! $store->logo || $request->input('logo') !== $store->logo->file_name) {
                if ($store->logo) {
                    $store->logo->delete();
                }
                $store->addMedia(storage_path('tmp/uploads/' . basename($request->input('logo'))))->toMediaCollection('logo');
            }
        } elseif ($store->logo) {
            $store->logo->delete();
        }

        if ($request->input('commercial_register', false)) {
            if (! $store->commercial_register || $request->input('commercial_register') !== $store->commercial_register->file_name) {
                if ($store->commercial_register) {
                    $store->commercial_register->delete();
                }
                $store->addMedia(storage_path('tmp/uploads/' . basename($request->input('commercial_register'))))->toMediaCollection('commercial_register');
            }
        } elseif ($store->commercial_register) {
            $store->commercial_register->delete();
        }

        return redirect()->route('admin.stores.index');
    }

    public function show(Store $store)
    {
        abort_if(Gate::denies('store_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $store->load('user', 'city', 'categories', 'storeOrders', 'storeSpecialOrders', 'storeStoreWithdrawRequests', 'storeCommissionHistories', 'storeStoreCities.city');

        $user = $store->user;

        return view('admin.store.stores.show', compact('store','user'));
    }

    public function destroy(Store $store)
    {
        abort_if(Gate::denies('store_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $store->user()->delete();
        $store->delete();

        return back();
    }

    public function massDestroy(MassDestroyStoreRequest $request)
    {
        $stores = Store::find(request('ids'));

        foreach ($stores as $store) {
            $store->user()->delete();
            $store->delete();
        }

        return response(null, Response::HTTP_NO_CONTENT);
    }

    public function storeCKEditorImages(Request $request)
    {
        abort_if(Gate::denies('store_create') && Gate::denies('store_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $model         = new Store();
        $model->id     = $request->input('crud_id', 0);
        $model->exists = true;
        $media         = $model->addMediaFromRequest('upload')->toMediaCollection('ck-media');

        return response()->json(['id' => $media->id, 'url' => $media->getUrl()], Response::HTTP_CREATED);
    }
}
