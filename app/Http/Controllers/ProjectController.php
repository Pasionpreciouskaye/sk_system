<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Http\Requests\ProjectRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    public function projectShow(Request $request)
    {
        $page_title = 'Project';
        $resource = 'project';

        $query = Project::query();

        if ($request->filled('search')) {
            $query->where('title', 'like', '%' . $request->search . '%');
        }

        $query->orderBy('created_at', 'desc');

        $data = $query->paginate(8)->withQueryString();

        return view('project', compact('page_title', 'resource', 'data'));
    }
    
    public function index(Request $request)
    {
        $page_title = 'Project';
        $resource = 'project';

        $query = Project::query();

        if ($request->filled('search')) {
            $query->where('title', 'like', '%' . $request->search . '%');
        }

        $query->orderBy('created_at', 'desc');

        $data = $query->paginate(8)->withQueryString();

        return view('project.index', compact('page_title', 'resource', 'data'));
    }

    public function show(Project $project)
    {
        $resource = 'project';
        return view('project.show', compact('project', 'resource'));
    }
    
    public function store(ProjectRequest $request)
    {
        $validated = $request->validated();
    
        if ($request->hasFile('file_name')) {
            $file = $request->file('file_name');
    
            $extension = $file->getClientOriginalExtension();
            $userId = Auth::id();
            $timestamp = now()->format('YmdHis');
    
            $filename = "project{$userId}_{$timestamp}.{$extension}";
            $destination = public_path('projects');
    
            $file->move($destination, $filename);
    
            $validated['file_name'] = $filename;
            $validated['file_path'] = "projects/{$filename}"; 
        }
    
        $validated['user_id'] = Auth::id();
    
        Project::create($validated);
    
        return redirect()
            ->route('project.index')
            ->with('success', 'Project successfully created!');
    }
    
    public function update(ProjectRequest $request, Project $project)
    {
        $validated = $request->validated();

        if ($request->hasFile('file_name')) {
            $oldPath = public_path($project->file_path);
            if (File::exists($oldPath)) {
                File::delete($oldPath);
            }
            
            $file = $request->file('file_name');
            $extension = $file->getClientOriginalExtension();
            $userId = Auth::id();
            $timestamp = now()->format('YmdHis');

            $filename = "project{$userId}_{$timestamp}.{$extension}";
            $file->move(public_path('projects'), $filename);

            $validated['file_name'] = $filename;
            $validated['file_path'] = "projects/{$filename}";
        } else {
            $validated['file_name'] = $project->file_name;
            $validated['file_path'] = $project->file_path;
        }

        $validated['user_id'] = Auth::id();

        $project->update($validated);

        return redirect()
            ->route('project.index')
            ->with('success', 'Project successfully updated!');
    }
    
    public function destroy(Project $project)
    {
        if ($project->file_path && File::exists(public_path($project->file_path))) {
            File::delete(public_path($project->file_path));
        }
    
        $project->delete();
    
        return redirect()
            ->route('project.index')
            ->with('success', 'Project successfully deleted!');
    }
}