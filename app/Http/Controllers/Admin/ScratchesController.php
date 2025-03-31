<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyScratchRequest;
use App\Http\Requests\StoreScratchRequest;
use App\Http\Requests\UpdateScratchRequest;
use App\Models\Scratch;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class ScratchesController extends Controller
{
    public function index(Request $request)
    {
        abort_if(Gate::denies('scratch_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = Scratch::query()->select(sprintf('%s.*', (new Scratch)->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate      = 'scratch_show';
                $editGate      = 'scratch_edit';
                $deleteGate    = 'scratch_delete';
                $crudRoutePart = 'scratches';

                return view('partials.datatablesActions', compact(
                    'viewGate',
                    'editGate',
                    'deleteGate',
                    'crudRoutePart',
                    'row'
                ));
            });

            $table->editColumn('id', function ($row) {
                return $row->id ? $row->id : '';
            });
            $table->editColumn('name', function ($row) {
                return $row->name ? $row->name : '';
            });
            $table->editColumn('code', function ($row) {
                return $row->code ? $row->code : '';
            });
            $table->editColumn('discount_type', function ($row) {
                return $row->discount_type ? Scratch::DISCOUNT_TYPE_SELECT[$row->discount_type] : '';
            });
            $table->editColumn('discount', function ($row) {
                return $row->discount ? $row->discount : '';
            });
            $table->editColumn('expiration_days', function ($row) {
                return $row->expiration_days ? $row->expiration_days : '';
            });

            $table->rawColumns(['actions', 'placeholder']);

            return $table->make(true);
        }

        return view('admin.scratches.index');
    }

    public function create()
    {
        abort_if(Gate::denies('scratch_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.scratches.create');
    }

    public function store(StoreScratchRequest $request)
    {
        $scratch = Scratch::create($request->all());

        return redirect()->route('admin.scratches.index');
    }

    public function edit(Scratch $scratch)
    {
        abort_if(Gate::denies('scratch_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.scratches.edit', compact('scratch'));
    }

    public function update(UpdateScratchRequest $request, Scratch $scratch)
    {
        $scratch->update($request->all());

        return redirect()->route('admin.scratches.index');
    }

    public function show(Scratch $scratch)
    {
        abort_if(Gate::denies('scratch_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.scratches.show', compact('scratch'));
    }

    public function destroy(Scratch $scratch)
    {
        abort_if(Gate::denies('scratch_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $scratch->delete();

        return back();
    }

    public function massDestroy(MassDestroyScratchRequest $request)
    {
        $scratches = Scratch::find(request('ids'));

        foreach ($scratches as $scratch) {
            $scratch->delete();
        }

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
