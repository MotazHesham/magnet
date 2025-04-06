<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait; 
use App\Http\Requests\Admin\UpdateEmailTemplateRequest;
use App\Models\EmailTemplate;
use Illuminate\Support\Facades\Gate;
use Illuminate\Http\Request; 
use Symfony\Component\HttpFoundation\Response; 

class EmailTemplatesController extends Controller
{
    use MediaUploadingTrait;

    public function index(Request $request)
    {
        abort_if(Gate::denies('email_template_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        
        $emailTemplates = EmailTemplate::where('user_type',request('user_type','customer'))->get();

        return view('admin.marketing.emailTemplates.index',compact('emailTemplates'));
    } 
    public function edit(EmailTemplate $emailTemplate)
    {
        abort_if(Gate::denies('email_template_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.marketing.emailTemplates.edit', compact('emailTemplate'));
    }

    public function update(UpdateEmailTemplateRequest $request, EmailTemplate $emailTemplate)
    {
        $emailTemplate->update($request->all());

        return redirect()->route('admin.email-templates.index',['user_type' => $emailTemplate->user_type]);
    }  
}
