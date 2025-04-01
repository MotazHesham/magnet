<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\Admin\MassDestroyPopupRequest;
use App\Http\Requests\Admin\StorePopupRequest;
use App\Http\Requests\Admin\UpdatePopupRequest;
use App\Models\Popup;
use Illuminate\Support\Facades\Gate;
use Illuminate\Http\Request;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class PopupsController extends Controller
{
    use MediaUploadingTrait;

    public function index(Request $request)
    {
        abort_if(Gate::denies('popup_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = Popup::query()->select(sprintf('%s.*', (new Popup)->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate      = 'popup_show';
                $editGate      = 'popup_edit';
                $deleteGate    = 'popup_delete';
                $crudRoutePart = 'popups';

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
            $table->editColumn('title', function ($row) {
                return $row->title ? $row->title : '';
            });
            $table->editColumn('image', function ($row) {
                if ($photo = $row->image) {
                    return sprintf(
                        '<a href="%s" target="_blank"><img src="%s" width="50px" height="50px"></a>',
                        $photo->url,
                        $photo->thumbnail
                    );
                }

                return '';
            });
            $table->editColumn('active', function ($row) {
                return '<input type="checkbox" disabled ' . ($row->active ? 'checked' : null) . '>';
            });

            $table->rawColumns(['actions', 'placeholder', 'image', 'active']);

            return $table->make(true);
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

        if ($request->input('image', false)) {
            $popup->addMedia(storage_path('tmp/uploads/' . basename($request->input('image'))))->toMediaCollection('image');
        }

        if ($media = $request->input('ck-media', false)) {
            Media::whereIn('id', $media)->update(['model_id' => $popup->id]);
        }

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

        if ($request->input('image', false)) {
            if (! $popup->image || $request->input('image') !== $popup->image->file_name) {
                if ($popup->image) {
                    $popup->image->delete();
                }
                $popup->addMedia(storage_path('tmp/uploads/' . basename($request->input('image'))))->toMediaCollection('image');
            }
        } elseif ($popup->image) {
            $popup->image->delete();
        }

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
