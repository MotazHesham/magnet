<?php

namespace App\Http\Controllers\Admin\Faq;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\MassDestroyFaqQuestionRequest;
use App\Http\Requests\Admin\StoreFaqQuestionRequest;
use App\Http\Requests\Admin\UpdateFaqQuestionRequest;
use App\Models\FaqCategory;
use App\Models\FaqQuestion;
use App\Utils\DataTableHandler;
use Illuminate\Support\Facades\Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response; 

class FaqQuestionController extends Controller
{
    public function index(Request $request)
    {
        abort_if(Gate::denies('faq_question_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $config = [
                'relations' => ['category'],
                'columns' => [ 
                    'category_category' => function ($row) {
                        return $row->category ? $row->category->category : '';
                    }, 
                ],
                'gates' => [
                    'view' => 'faq_question_show',
                    'edit' => 'faq_question_edit', 
                    'delete' => 'faq_question_delete'
                ],
                'crudRoutePart' => 'faq-questions'
            ];

            $handler = new DataTableHandler(new FaqQuestion(), $config);
            return $handler->handle($request);
        }

        return view('admin.faqQuestions.index');
    }

    public function create()
    {
        abort_if(Gate::denies('faq_question_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $categories = FaqCategory::pluck('category', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.faqQuestions.create', compact('categories'));
    }

    public function store(StoreFaqQuestionRequest $request)
    {
        $faqQuestion = FaqQuestion::create($request->all());

        return redirect()->route('admin.faq-questions.index');
    }

    public function edit(FaqQuestion $faqQuestion)
    {
        abort_if(Gate::denies('faq_question_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $categories = FaqCategory::pluck('category', 'id')->prepend(trans('global.pleaseSelect'), '');

        $faqQuestion->load('category');

        return view('admin.faqQuestions.edit', compact('categories', 'faqQuestion'));
    }

    public function update(UpdateFaqQuestionRequest $request, FaqQuestion $faqQuestion)
    {
        $faqQuestion->update($request->all());

        return redirect()->route('admin.faq-questions.index');
    }

    public function show(FaqQuestion $faqQuestion)
    {
        abort_if(Gate::denies('faq_question_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $faqQuestion->load('category');

        return view('admin.faqQuestions.show', compact('faqQuestion'));
    }

    public function destroy(FaqQuestion $faqQuestion)
    {
        abort_if(Gate::denies('faq_question_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $faqQuestion->delete();

        return back();
    }

    public function massDestroy(MassDestroyFaqQuestionRequest $request)
    {
        $faqQuestions = FaqQuestion::find(request('ids'));

        foreach ($faqQuestions as $faqQuestion) {
            $faqQuestion->delete();
        }

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
