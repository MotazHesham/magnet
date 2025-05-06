<?php

namespace App\Http\Controllers\Admin\Setting;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\MassDestroyContactuRequest;
use App\Models\Contactu;
use App\Utils\DataTableHandler;
use Illuminate\Support\Facades\Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response; 

class ContactusController extends Controller
{
    public function index(Request $request)
    {
        abort_if(Gate::denies('contactu_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $config = [
                'columns' => [ ], 
                'gates' => [
                    'view' => false,
                    'edit' => false,
                    'delete' => false
                ],
                'crudRoutePart' => 'contactus'
            ];

            $handler = new DataTableHandler(new Contactu(), $config);
            return $handler->handle($request);
        } 

        return view('admin.contactus.index');
    }

    public function show(Contactu $contactu)
    {
        abort_if(Gate::denies('contactu_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.contactus.show', compact('contactu'));
    }

    public function destroy(Contactu $contactu)
    {
        abort_if(Gate::denies('contactu_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $contactu->delete();

        return back();
    }

    public function massDestroy(MassDestroyContactuRequest $request)
    {
        $contactus = Contactu::find(request('ids'));

        foreach ($contactus as $contactu) {
            $contactu->delete();
        }

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
