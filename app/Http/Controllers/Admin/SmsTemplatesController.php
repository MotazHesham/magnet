<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\Admin\UpdateSmsTemplateRequest;
use App\Models\SmsTemplate;
use Illuminate\Support\Facades\Gate;
use Illuminate\Http\Request;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class SmsTemplatesController extends Controller
{
    use MediaUploadingTrait;

    public function index(Request $request)
    {
        abort_if(Gate::denies('sms_template_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        
        $smsTemplates = SmsTemplate::all();

        return view('admin.smsTemplates.index',compact('smsTemplates'));
    }

    public function edit(SmsTemplate $smsTemplate)
    {
        abort_if(Gate::denies('sms_template_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.smsTemplates.edit', compact('smsTemplate'));
    }

    public function update(UpdateSmsTemplateRequest $request, SmsTemplate $smsTemplate)
    {
        $smsTemplate->update($request->all());

        return redirect()->route('admin.sms-templates.index');
    } 
}
