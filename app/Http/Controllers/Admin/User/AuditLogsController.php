<?php

namespace App\Http\Controllers\Admin\User;

use App\Http\Controllers\Controller;
use App\Models\AuditLog;
use App\Utils\DataTableHandler;
use Illuminate\Support\Facades\Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AuditLogsController extends Controller
{
    public function index(Request $request)
    {
        abort_if(Gate::denies('audit_log_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $config = [
                'columns' => [
                    'id' => function ($row) {
                        return $row->id ? $row->id : '';
                    },
                    'description' => function ($row) {
                        return $row->description ? $row->description : '';
                    },
                    'subject_id' => function ($row) {
                        return $row->subject_id ? $row->subject_id : '';
                    },
                    'subject_type' => function ($row) {
                        return $row->subject_type ? $row->subject_type : '';
                    },
                    'user_id' => function ($row) {
                        return $row->user_id ? $row->user_id : '';
                    },
                    'host' => function ($row) {
                        return $row->host ? $row->host : '';
                    }
                ],
                'gates' => [
                    'view' => 'audit_log_show',
                    'edit' => 'audit_log_edit',
                    'delete' => 'audit_log_delete'
                ],
                'crudRoutePart' => 'audit-logs'
            ];

            $handler = new DataTableHandler(new AuditLog(), $config);
            return $handler->handle($request);
        }

        return view('admin.auditLogs.index');
    }

    public function show(AuditLog $auditLog)
    {
        abort_if(Gate::denies('audit_log_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.auditLogs.show', compact('auditLog'));
    }
}
