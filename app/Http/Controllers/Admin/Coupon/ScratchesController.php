<?php

namespace App\Http\Controllers\Admin\Coupon;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\MassDestroyScratchRequest;
use App\Http\Requests\Admin\StoreScratchRequest;
use App\Http\Requests\Admin\UpdateScratchRequest;
use App\Models\Scratch;
use Illuminate\Support\Facades\Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Utils\DataTableHandler;

class ScratchesController extends Controller
{
    public function index(Request $request)
    {
        abort_if(Gate::denies('scratch_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $config = [
                'columns' => [ 
                    'discount_type' => function ($row) {
                        return $row->discount_type ? Scratch::DISCOUNT_TYPE_SELECT[$row->discount_type] : '';
                    }, 
                ],
                'gates' => [
                    'view' => 'scratch_show',
                    'edit' => 'scratch_edit',
                    'delete' => 'scratch_delete'
                ],
                'crudRoutePart' => 'scratches'
            ];

            $handler = new DataTableHandler(new Scratch(), $config);
            return $handler->handle($request);
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
