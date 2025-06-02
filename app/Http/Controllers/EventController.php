<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Http\Requests\ProjectRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Http\Request;
use App\Http\Requests\EventRegistrationRequest;
use App\Models\EventRegistration;
use App\DataTables\CmsDataTable;

class EventController extends Controller
{
    public function eventRegistration(EventRegistrationRequest $request, Event $event)
    {
        EventRegistration::create([
            'full_name' => $request->full_name,
            'email' => $request->email,
            'contact_number' => $request->contact_number,
            'event_id' => $event->id,
        ]);

        return redirect()
            ->route('event')
            ->with('success', 'Registration successful!');
    }

    public function eventShow(CmsDataTable $dataTabke, Request $request)
    {
        $page_title = 'event';
        $resource = 'event';

        $query = Event::query();

        if ($request->filled('search')) {
            $query->where('title', 'like', '%' . $request->search . '%');
        }

        $query->orderBy('created_at', 'desc');

        $data = $query->paginate(8)->withQueryString();

        return view('event', compact('page_title', 'resource', 'data'));
    }

    public function index(Request $request)
    {
        $page_title = 'Event';
        $resource = 'event';

        $query = event::query();

        if ($request->filled('search')) {
            $query->where('title', 'like', '%' . $request->search . '%');
        }

        $query->orderBy('created_at', 'desc');

        $data = $query->paginate(8)->withQueryString();

        return view('project.index', compact('page_title', 'resource', 'data'));
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
            $destination = public_path('events');
    
            $file->move($destination, $filename);
    
            $validated['file_name'] = $filename;
            $validated['file_path'] = "events/{$filename}"; 
        }
    
        $validated['user_id'] = Auth::id();
    
        Event::create($validated);
    
        return redirect()
            ->route('event.index')
            ->with('success', 'Event successfully created!');
    }
    
    public function show(CmsDataTable $dataTable, Event $event)
    {
        $resource = 'event';
        $columns = ['id', 'full name', 'email', 'contact number'];
        $data = EventRegistration::where('event_id', $event->id)->get();

        return $dataTable
            ->render('project.show', compact(
                'dataTable', 
                'resource',
                'event',
                'columns',
                'data',
            ));
    }
    
    public function update(ProjectRequest $request, Event $event)
    {
        $validated = $request->validated();
    
        if ($request->hasFile('file_name')) {
            if ($event->file_path && File::exists(public_path($event->file_path))) {
                File::delete(public_path($event->file_path));
            }
    
            $file = $request->file('file_name');
            $extension = $file->getClientOriginalExtension();
            $userId = Auth::id();
            $timestamp = now()->format('YmdHis');
    
            $filename = "event{$userId}_{$timestamp}.{$extension}";
            $destination = public_path('events');
    
            $file->move($destination, $filename);
    
            $validated['file_name'] = $filename;
            $validated['file_path'] = "events/{$filename}";
        } else {
            $validated['file_name'] = $event->file_name;
            $validated['file_path'] = $event->file_path;
        }
    
        $validated['user_id'] = Auth::id();
    
        $event->update($validated);
    
        return redirect()
            ->route('event.index')
            ->with('success', 'Event successfully updated!');
    }
    
    public function destroy(Event $event)
    {
        if ($event->file_path && File::exists(public_path($event->file_path))) {
            File::delete(public_path($event->file_path));
        }
    
        $event->delete();
    
        return redirect()
            ->route('event.index')
            ->with('success', 'Event successfully deleted!');
    }
}
