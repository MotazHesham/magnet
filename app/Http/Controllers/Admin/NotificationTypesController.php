<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\MassDestroyNotificationTypeRequest;
use App\Http\Requests\Admin\StoreNotificationTypeRequest;
use App\Http\Requests\Admin\UpdateNotificationTypeRequest;
use App\Models\NotificationType;
use Illuminate\Support\Facades\Gate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class NotificationTypesController extends Controller
{
    public function index(Request $request)
    {
        abort_if(Gate::denies('notification_type_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $notificationTypes = NotificationType::where('user_type',request('user_type','customer'))->paginate(10);

        return view('admin.notificationTypes.index',compact('notificationTypes'));
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
        $notificationType->setTranslation('name',$request->lang,$request->name);
        $notificationType->setTranslation('default_text',$request->lang,$request->default_text);
        $notificationType->save();

        return redirect()->route('admin.notification-types.index');
    }

    public function destroy(NotificationType $notificationType)
    {
        abort_if(Gate::denies('notification_type_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden'); 
        
        $notificationType->delete();

        return back();
    }
}
