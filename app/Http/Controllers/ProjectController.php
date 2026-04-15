<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\ProjectRegistration;
use App\Http\Requests\ProjectRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;

class ProjectController extends Controller
{
    public function index(Request $request)
    {
        $page_title = 'Project';
        $resource = 'project';

        $query = Project::query();

        if ($request->filled('search')) {
            $query->where('title', 'like', '%' . $request->search . '%');
        }

        $data = $query->orderBy('created_at', 'desc')->paginate(8)->withQueryString();

        return view('project.index', compact('page_title', 'resource', 'data'));
    }

    public function projectShow(Request $request)
    {
        $page_title = 'Project';
        $resource = 'project';

        $query = Project::query();

        if ($request->filled('search')) {
            $query->where('title', 'like', '%' . $request->search . '%');
        }

        $data = $query->orderBy('created_at', 'desc')->paginate(8)->withQueryString();

        return view('project', compact('page_title', 'resource', 'data'));
    }

    public function show(Project $project)
    {
        $resource = 'project';
        $columns = ['ID', 'Full Name', 'Email', 'Contact Number'];
        $data = ProjectRegistration::where('project_id', $project->id)->get();
        return view('project.show', compact('project', 'resource', 'columns', 'data'));
    }

    public function register(Request $request, Project $project)
    {
        $request->validate([
            'full_name'      => 'required|string|max:255',
            'email'          => 'required|email|max:255|unique:project_registrations,email,NULL,id,project_id,' . $project->id,
            'contact_number' => 'required|string|max:15',
        ], [
            'email.unique' => 'You have already registered for this project.',
        ]);

        ProjectRegistration::create([
            'full_name'      => $request->full_name,
            'email'          => $request->email,
            'contact_number' => $request->contact_number,
            'project_id'     => $project->id,
        ]);

        return redirect()->route('project')->with('success', 'Registration successful!');
    }

    public function store(ProjectRequest $request)
    {
        $validated = $request->validated();

        if ($request->hasFile('file_name')) {
            $file = $request->file('file_name');
            $extension = strtolower($file->getClientOriginalExtension());
            $filename = "project" . Auth::id() . "_" . now()->format('YmdHis') . "." . $extension;

            $file->move(public_path('projects'), $filename);

            $validated['file_name'] = $filename;
            $validated['file_path'] = "projects/{$filename}";
        }

        $validated['user_id'] = Auth::id();
        $validated['announcement'] = $validated['announcement'] ?? '';

        Project::create($validated);

        \App\Models\AuditTrail::log('create', 'Project', "Created project: {$validated['title']}");

        return redirect()->route('project.index')->with('success', 'Project successfully created!');
    }

    public function update(ProjectRequest $request, Project $project)
    {
        $validated = $request->validated();

        if ($request->hasFile('file_name')) {
            if ($project->file_path && File::exists(public_path($project->file_path))) {
                File::delete(public_path($project->file_path));
            }

            $file = $request->file('file_name');
            $extension = strtolower($file->getClientOriginalExtension());
            $filename = "project" . Auth::id() . "_" . now()->format('YmdHis') . "." . $extension;

            $file->move(public_path('projects'), $filename);

            $validated['file_name'] = $filename;
            $validated['file_path'] = "projects/{$filename}";
        } else {
            $validated['file_name'] = $project->file_name;
            $validated['file_path'] = $project->file_path;
        }

        $validated['user_id'] = Auth::id();
        $validated['announcement'] = $request->input('announcement') ?? '';

        $project->update($validated);

        \App\Models\AuditTrail::log('update', 'Project', "Updated project: {$project->title}");

        return redirect()->route('project.index')->with('success', 'Project successfully updated!');
    }

    public function destroy(Project $project)
    {
        $title = $project->title;
        if ($project->file_path && File::exists(public_path($project->file_path))) {
            File::delete(public_path($project->file_path));
        }
        $project->delete();

        \App\Models\AuditTrail::log('delete', 'Project', "Deleted project: {$title}");

        return redirect()->route('project.index')->with('success', 'Project successfully deleted!');
    }
}
