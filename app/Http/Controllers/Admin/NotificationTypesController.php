<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyNotificationTypeRequest;
use App\Http\Requests\StoreNotificationTypeRequest;
use App\Http\Requests\UpdateNotificationTypeRequest;
use App\Models\NotificationType;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class NotificationTypesController extends Controller
{
    public function index(Request $request)
    {
        abort_if(Gate::denies('notification_type_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = NotificationType::query()->select(sprintf('%s.*', (new NotificationType)->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate      = 'notification_type_show';
                $editGate      = 'notification_type_edit';
                $deleteGate    = 'notification_type_delete';
                $crudRoutePart = 'notification-types';

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
            $table->editColumn('user_type', function ($row) {
                return $row->user_type ? $row->user_type : '';
            });
            $table->editColumn('type', function ($row) {
                return $row->type ? $row->type : '';
            });
            $table->editColumn('name', function ($row) {
                return $row->name ? $row->name : '';
            });
            $table->editColumn('default_text', function ($row) {
                return $row->default_text ? $row->default_text : '';
            });
            $table->editColumn('status', function ($row) {
                return '<input type="checkbox" disabled ' . ($row->status ? 'checked' : null) . '>';
            });

            $table->rawColumns(['actions', 'placeholder', 'status']);

            return $table->make(true);
        }

        return view('admin.notificationTypes.index');
    }

    public function create()
    {
        abort_if(Gate::denies('notification_type_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.notificationTypes.create');
    }

    public function store(StoreNotificationTypeRequest $request)
    {
        $notificationType = NotificationType::create($request->all());

        return redirect()->route('admin.notification-types.index');
    }

    public function edit(NotificationType $notificationType)
    {
        abort_if(Gate::denies('notification_type_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.notificationTypes.edit', compact('notificationType'));
    }

    public function update(UpdateNotificationTypeRequest $request, NotificationType $notificationType)
    {
        $notificationType->update($request->all());

        return redirect()->route('admin.notification-types.index');
    }

    public function show(NotificationType $notificationType)
    {
        abort_if(Gate::denies('notification_type_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.notificationTypes.show', compact('notificationType'));
    }

    public function destroy(NotificationType $notificationType)
    {
        abort_if(Gate::denies('notification_type_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $notificationType->delete();

        return back();
    }

    public function massDestroy(MassDestroyNotificationTypeRequest $request)
    {
        $notificationTypes = NotificationType::find(request('ids'));

        foreach ($notificationTypes as $notificationType) {
            $notificationType->delete();
        }

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
