<?php

namespace App\Http\Controllers\Admin\Marketing;

use App\Http\Controllers\Controller; 
use App\Models\NotificationCustom;
use App\Models\NotificationType;
use App\Models\User;
use App\Notifications\CustomNotification;
use Illuminate\Support\Facades\Gate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Notification;
use Symfony\Component\HttpFoundation\Response;

class NotificationCustomController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('notification_custom_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $notificationCustoms = NotificationCustom::with(['notification_type'])->get();

        return view('admin.marketing.notificationCustoms.index', compact('notificationCustoms'));
    }
    public function create()
    {
        abort_if(Gate::denies('notification_custom_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $notification_types = NotificationType::where('type','custom')->where('status',1)->get()
                            ->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.marketing.notificationCustoms.create', compact('notification_types'));
    }


    public function store(Request $request)
    {

        $notificationType = NotificationType::find($request->notification_type_id);
        
        $notificationCustom = NotificationCustom::create([ 
            'notification_type_id' => $request->notification_type_id,
            'title' => [
                'ar' => $notificationType->getTranslation('name','ar'),
                'en' => $notificationType->getTranslation('name','en')
            ],
            'description' => [
                'ar' => $notificationType->getTranslation('default_text','ar'),
                'en' => $notificationType->getTranslation('default_text','en')
            ],
            'link' => $request->link,
        ]);
        
        $data = array();
        $data['link'] = $request->link;
        $data['notification_type_id'] = $request->notification_type_id; 
        $data['notification_custom_id'] = $notificationCustom->id; 

        foreach(User::where('user_type',$notificationType->user_type)->get() as $user){
            
            Notification::send($user, new CustomNotification($data));
        }

        return redirect()->route('admin.notification-customs.index');
    } 

    public function edit(NotificationCustom $notificationCustom)
    {
        abort_if(Gate::denies('notification_custom_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $notificationCustom->load('notification_type');

        return view('admin.marketing.notificationCustoms.edit', compact('notificationCustom'));
    }

    public function update(Request $request, NotificationCustom $notificationCustom)
    { 
        $notificationCustom->setTranslation('title',$request->lang,$request->title);
        $notificationCustom->setTranslation('description',$request->lang,$request->description);
        $notificationCustom->save();

        return redirect()->route('admin.notification-customs.index');
    }

    public function show(NotificationCustom $notificationCustom)
    {
        abort_if(Gate::denies('notification_custom_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $notificationCustom->load('notification_type','users.notifiable');

        return view('admin.marketing.notificationCustoms.show', compact('notificationCustom'));
    }

    public function destroy(NotificationCustom $notificationCustom)
    {
        abort_if(Gate::denies('notification_custom_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $notificationCustom->users()->delete();
        $notificationCustom->delete();

        return back();
    }
}
