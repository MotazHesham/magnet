<?php

namespace App\Http\Controllers\Admin\Product;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\MassDestroyColorRequest;
use App\Http\Requests\Admin\StoreColorRequest;
use App\Http\Requests\Admin\UpdateColorRequest;
use App\Models\Color;
use App\Utils\DataTableHandler;
use App\Utils\MediaHandler;
use Illuminate\Support\Facades\Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ColorsController extends Controller
{
    public function __construct(
        protected MediaHandler $mediaHandler
    ) {}

    public function index(Request $request)
    {
        abort_if(Gate::denies('color_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $config = [
                'columns' => [ 
                    'color' => function ($row) {
                        return $row->code ? '<div style="height:25px;width:25px;background:'.$row->code.';border-radius:5px"></div>' : '';
                    },
                ],
                'rawColumns' => ['color'],
                'gates' => [
                    'view' => false,
                    'edit' => 'color_edit',
                    'delete' => 'color_delete'
                ],
                'crudRoutePart' => 'colors'
            ];

            $handler = new DataTableHandler(new Color(), $config);
            return $handler->handle($request);
        }

        return view('admin.product.colors.index');
    }

    public function create()
    {
        abort_if(Gate::denies('color_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.product.colors.create');
    }

    public function store(StoreColorRequest $request)
    {
        $color = Color::create($request->all());

        return redirect()->route('admin.colors.index');
    }

    public function edit(Color $color)
    {
        abort_if(Gate::denies('color_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.product.colors.edit', compact('color'));
    }

    public function update(UpdateColorRequest $request, Color $color)
    {
        $color->update($request->all());

        return redirect()->route('admin.colors.index');
    }

    public function show(Color $color)
    {
        abort_if(Gate::denies('color_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.product.colors.show', compact('color'));
    }

    public function destroy(Color $color)
    {
        abort_if(Gate::denies('color_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $color->delete();

        return back();
    }

    public function massDestroy(MassDestroyColorRequest $request)
    {
        Color::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
