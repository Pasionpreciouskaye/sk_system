<?php

namespace App\Http\Controllers;

use App\Models\Feedback;
use App\Http\Requests\FeedbackRequest;
use App\DataTables\CmsDataTable;

class FeedbackController extends Controller
{
    public function index(CmsDataTable $dataTable)
    {
        $page_title = 'Feedback';
        $resource = 'feedback';
        $columns = ['id', 'subject', 'message'];
        $data = Feedback::getAllFeedbacks();

        return $dataTable
            ->render('cms.index', compact(
                'page_title',
                'resource', 
                'columns',
                'data',
                'dataTable',
            ));
    }

    public function store(FeedbackRequest $request)
    {
        $validated = $request->validated();
        Feedback::create($validated);

        return redirect()
            ->route('contact')
            ->with('success', 'Feedback submitted successfully!');
    }
}
