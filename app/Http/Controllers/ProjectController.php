<?php

namespace App\Http\Controllers;

use App\Models\Project;
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
        return view('project.show', compact('project', 'resource'));
    }

    public function store(ProjectRequest $request)
{
    $validated = $request->validated();

    if ($request->hasFile('file_name')) {
        $file = $request->file('file_name');
        $extension = strtolower($file->getClientOriginalExtension());
        $userId = Auth::id();
        $timestamp = now()->format('YmdHis');

        $filename = "project{$userId}_{$timestamp}.{$extension}";
        $file->move(public_path('projects'), $filename);

        $validated['file_name'] = $filename;
        $validated['file_path'] = "projects/{$filename}";
        $validated['file_type'] = in_array($extension, ['jpg', 'jpeg', 'png', 'webp']) ? 'image' : 'file';
    }

    $validated['user_id'] = Auth::id();

    // 🆕 Convert announcement text to formatted HTML
    $announcement = $validated['announcement'] ?? '';
    $lines = explode("\n", trim($announcement));
    $html = '';

    foreach ($lines as $line) {
        if (strpos($line, ':') !== false) {
            [$label, $content] = explode(':', $line, 2);
            $label = trim($label);
            $content = trim($content);
            $html .= "<p><span class='font-semibold text-pink-600'>{$label}:</span> {$content}</p>\n";
        } else {
            $html .= "<p>{$line}</p>\n";
        }
    }

    $validated['content'] = $html;
    unset($validated['announcement']);

    Project::create($validated);

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
        $userId = Auth::id();
        $timestamp = now()->format('YmdHis');

        $filename = "project{$userId}_{$timestamp}.{$extension}";
        $file->move(public_path('projects'), $filename);

        $validated['file_name'] = $filename;
        $validated['file_path'] = "projects/{$filename}";
        $validated['file_type'] = in_array($extension, ['jpg', 'jpeg', 'png', 'webp']) ? 'image' : 'file';
    } else {
        $validated['file_name'] = $project->file_name;
        $validated['file_path'] = $project->file_path;
        $validated['file_type'] = $project->file_type;
    }

    $validated['user_id'] = Auth::id();

    // 🆕 Convert announcement text to formatted HTML
    $announcement = $validated['announcement'] ?? '';
    $lines = explode("\n", trim($announcement));
    $html = '';

    foreach ($lines as $line) {
        if (strpos($line, ':') !== false) {
            [$label, $content] = explode(':', $line, 2);
            $label = trim($label);
            $content = trim($content);
            $html .= "<p><span class='font-semibold text-pink-600'>{$label}:</span> {$content}</p>\n";
        } else {
            $html .= "<p>{$line}</p>\n";
        }
    }

    $validated['content'] = $html;
    unset($validated['announcement']);

    $project->update($validated);

    return redirect()->route('project.index')->with('success', 'Project successfully updated!');
}

    public function destroy(Project $project)
    {
        if ($project->file_path && File::exists(public_path($project->file_path))) {
            File::delete(public_path($project->file_path));
        }

        $project->delete();

        return redirect()->route('project.index')->with('success', 'Project successfully deleted!');
    }
}
