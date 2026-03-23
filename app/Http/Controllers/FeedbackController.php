<?php

namespace App\Http\Controllers;

use App\Models\Feedback;
use Illuminate\Http\Request;
use App\Http\Requests\FeedbackRequest;

class FeedbackController extends Controller
{
    public function index(Request $request)
    {
        $page_title = 'Feedback';
        $resource = 'feedback';
        $columns = ['#', 'name', 'email', 'subject', 'message'];

        // Search query builder
        $query = Feedback::query();

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where('name', 'like', "%$search%")
                  ->orWhere('email', 'like', "%$search%")
                  ->orWhere('subject', 'like', "%$search%");
        }

        $perPage = $request->get('per_page', 10);
        $data = $query->orderBy('created_at', 'desc')->paginate($perPage)->withQueryString();


        return view('cms.feedback.index', compact('page_title', 'resource', 'columns', 'data'));
    }

    public function store(FeedbackRequest $request)
    {
        Feedback::create($request->validated());

        return redirect()->back()->with('success', 'Thank you for your feedback!');
    }

    public function destroy($id)
    {
        $feedback = Feedback::findOrFail($id);
        $feedback->delete();

        return redirect()->route('feedback.index')->with('success', 'Feedback deleted successfully!');
    }
}
