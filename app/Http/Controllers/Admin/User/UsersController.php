<?php

namespace App\Http\Controllers\Admin\User;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\Admin\MassDestroyUserRequest;
use App\Http\Requests\Admin\StoreUserRequest;
use App\Http\Requests\Admin\UpdateUserRequest;
use App\Models\City;
use App\Models\Role;
use App\Models\User;
use App\Utils\DataTableHandler;
use App\Utils\MediaHandler;
use Illuminate\Support\Facades\Gate;
use Illuminate\Http\Request;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Symfony\Component\HttpFoundation\Response;

class UsersController extends Controller
{
    use MediaUploadingTrait;

    public function __construct(
        protected MediaHandler $mediaHandler
    ) {}

    public function index(Request $request)
    {
        abort_if(Gate::denies('user_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $config = [
                'relations' => ['roles', 'city'],
                'conditions' => [
                    ['column' => 'user_type', 'operator' => '=', 'value' => 'staff'], 
                ],
                'columns' => [ 
                    'approved' => [
                        'type' => 'checkbox',
                        'options' => [
                            'model' => User::class
                        ]
                    ],
                    'verified' => [
                        'type' => 'checkbox',
                        'options' => [
                            'model' => User::class
                        ]
                    ],
                    'roles' => [
                        'type' => 'relation-many',
                        'options' => [
                            'column' => 'title',
                        ]
                    ], 
                    'block' => [
                        'type' => 'checkbox',
                        'options' => [
                            'model' => User::class
                        ]
                    ],
                    'photo' => [
                        'type' => 'image', 
                    ],
                ],
                'gates' => [
                    'view' => 'user_show',
                    'edit' => 'user_edit',
                    'delete' => 'user_delete'
                ],
                'crudRoutePart' => 'users'
            ];

            $handler = new DataTableHandler(new User(), $config);
            return $handler->handle($request);
        }

        return view('admin.users.index');
    }

    public function create()
    {
        abort_if(Gate::denies('user_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $roles = Role::pluck('title', 'id');

        $cities = City::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.users.create', compact('cities', 'roles'));
    }

    public function store(StoreUserRequest $request)
    {
        $user = User::create($request->all());
        $user->roles()->sync($request->input('roles', []));
        
        if ($request->input('photo', false)) {
            $this->mediaHandler->handleMediaUpload($user, 'photo', $request->input('photo'));
        }

        if ($media = $request->input('ck-media', false)) {
            Media::whereIn('id', $media)->update(['model_id' => $user->id]);
        }

        return redirect()->route('admin.users.index');
    }

    public function edit(User $user)
    {
        abort_if(Gate::denies('user_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $roles = Role::pluck('title', 'id');

        $cities = City::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $user->load('roles', 'city');

        return view('admin.users.edit', compact('cities', 'roles', 'user'));
    }

    public function update(UpdateUserRequest $request, User $user)
    {
        $user->update($request->all());
        $user->roles()->sync($request->input('roles', []));
        
        if ($request->input('photo', false)) {
            $this->mediaHandler->handleMediaUpload($user, 'photo', $request->input('photo'));
        }

        return redirect()->route('admin.users.index');
    }

    public function show(User $user)
    {
        abort_if(Gate::denies('user_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $user->load('roles', 'city', 'userProductReviews', 'userAddresses', 'userCustomers', 'userCustomerPoints');

        return view('admin.users.show', compact('user'));
    }

    public function destroy(User $user)
    {
        abort_if(Gate::denies('user_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $user->delete();

        return back();
    }

    public function massDestroy(MassDestroyUserRequest $request)
    {
        $users = User::find(request('ids'));

        foreach ($users as $user) {
            $user->delete();
        }

        return response(null, Response::HTTP_NO_CONTENT);
    }

    public function storeCKEditorImages(Request $request)
    {
        abort_if(Gate::denies('user_create') && Gate::denies('user_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $model         = new User();
        $model->id     = $request->input('crud_id', 0);
        $model->exists = true;
        $media         = $model->addMediaFromRequest('upload')->toMediaCollection('ck-media');

        return response()->json(['id' => $media->id, 'url' => $media->getUrl()], Response::HTTP_CREATED);
    }
}
