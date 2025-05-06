<?php

namespace App\Http\Controllers\Admin\Store;

use App\Http\Controllers\Controller;  
use App\Models\StoreComplaint;
use App\Utils\DataTableHandler;
use Illuminate\Support\Facades\Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class StoreComplaintsController extends Controller
{
    public function index(Request $request)
    {
        abort_if(Gate::denies('store_complaint_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $config = [
                'relations' => ['store', 'user'],
                'columns' => [
                    'store_store_name' => function ($row) {
                        return $row->store ? $row->store->store_name : '';
                    },
                    'user_name' => function ($row) {
                        return $row->user ? $row->user->name : '';
                    },
                    'reason' => function ($row) {
                        return $row->reason ? $row->reason : '';
                    },
                ],
                'gates' => [
                    'view' => false,
                    'edit' => false,
                    'delete' => false
                ],
                'crudRoutePart' => 'store-complaints'
            ];

            $handler = new DataTableHandler(new StoreComplaint(), $config);
            return $handler->handle($request); 
        }

        return view('admin.store.storeComplaints.index');
    } 
}
