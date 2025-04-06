<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Mail\EmailManager;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Mail;

class BusinessSettingsController extends Controller
{
    public function smtp_settings(){
        return view('admin.bussinessSettings.smtp-settings');
    }
    
    public function env_key_update(Request $request)
    {
        foreach ($request->types as $type) {
            overWriteEnvFile($type, $request[$type]);
        }

        Artisan::call('cache:clear');
        toast(trans('flash.success'),'success');
        return back();
    }
    
    public function testEmail(Request $request){
        $array['view'] = 'emails.newsletter';
        $array['subject'] = "SMTP Test";
        $array['from'] = env('MAIL_FROM_ADDRESS');
        $array['content'] = "This is a test email.";

        try {
            Mail::to($request->email)->queue(new EmailManager($array));
        } catch (\Exception $e) {
            dd($e);
        }

        toast('An email has been sent.','success');
        return back();
    }
}
