<?php

namespace App\Http\Controllers\Admin\Setting;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\Admin\MassDestroyPopupRequest;
use App\Http\Requests\Admin\StorePopupRequest;
use App\Http\Requests\Admin\UpdatePopupRequest;
use App\Models\Popup;
use App\Utils\DataTableHandler;
use App\Utils\MediaHandler;
use Illuminate\Support\Facades\Gate;
use Illuminate\Http\Request;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Symfony\Component\HttpFoundation\Response; 

class PopupsController extends Controller
{
    use MediaUploadingTrait;

    protected $mediaHandler;

    public function __construct(MediaHandler $mediaHandler)
    {
        $this->mediaHandler = $mediaHandler;
    }
    public function index(Request $request)
    {
        abort_if(Gate::denies('popup_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $config = [
                'columns' => [ 
                    'active' => [
                        'type' => 'checkbox',
                        'options' => [
                            'model' => Popup::class
                        ]
                    ],
                    'image' => [
                        'type' => 'image', 
                    ],
                ], 
                'gates' => [
                    'view' => 'popup_show',
                    'edit' => 'popup_edit',
                    'delete' => 'popup_delete'
                ],
                'crudRoutePart' => 'popups'
            ];

            $handler = new DataTableHandler(new Popup(), $config);
            return $handler->handle($request);
        }  

        return view('admin.popups.index');
    }

    public function create()
    {
        abort_if(Gate::denies('popup_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.popups.create');
    }

    public function store(StorePopupRequest $request)
    {
        $popup = Popup::create($request->all());

        $this->mediaHandler->handleMediaUpload($popup, 'image', $request->input('image'));

        return redirect()->route('admin.popups.index');
    }

    public function edit(Popup $popup)
    {
        abort_if(Gate::denies('popup_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.popups.edit', compact('popup'));
    }

    public function update(UpdatePopupRequest $request, Popup $popup)
    {
        $popup->update($request->all());

        $this->mediaHandler->handleMediaUpload($popup, 'image', $request->input('image'));

        return redirect()->route('admin.popups.index');
    }

    public function show(Popup $popup)
    {
        abort_if(Gate::denies('popup_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.popups.show', compact('popup'));
    }

    public function destroy(Popup $popup)
    {
        abort_if(Gate::denies('popup_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $popup->delete();

        return back();
    }

    public function massDestroy(MassDestroyPopupRequest $request)
    {
        $popups = Popup::find(request('ids'));

        foreach ($popups as $popup) {
            $popup->delete();
        }

        return response(null, Response::HTTP_NO_CONTENT);
    }

    public function storeCKEditorImages(Request $request)
    {
        abort_if(Gate::denies('popup_create') && Gate::denies('popup_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $model         = new Popup();
        $model->id     = $request->input('crud_id', 0);
        $model->exists = true;
        $media         = $model->addMediaFromRequest('upload')->toMediaCollection('ck-media');

        return response()->json(['id' => $media->id, 'url' => $media->getUrl()], Response::HTTP_CREATED);
    }
}
