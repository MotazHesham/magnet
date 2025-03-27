<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyNotificationTypeRequest;
use App\Http\Requests\StoreNotificationTypeRequest;
use App\Http\Requests\UpdateNotificationTypeRequest;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class NotificationTypesController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('notification_type_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

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
