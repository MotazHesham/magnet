<?php

namespace App\Http\Controllers\Admin\Marketing;

use App\Http\Controllers\Controller;
use App\Models\Search;
use App\Utils\DataTableHandler;
use Illuminate\Support\Facades\Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class SearchesController extends Controller
{
    public function index(Request $request)
    {
        abort_if(Gate::denies('search_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $config = [
                'columns' => [ ],
                'gates' => [
                    'view' => false,
                    'edit' => false,
                    'delete' => false
                ],
                'crudRoutePart' => 'searches'
            ];

            $handler = new DataTableHandler(new Search(), $config);
            return $handler->handle($request);
        }

        return view('admin.marketing.searches.index');
    } 
}
