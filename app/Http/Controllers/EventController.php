<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\EventRegistration;
use App\Http\Requests\ProjectRequest;
use App\Http\Requests\EventRegistrationRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;

class EventController extends Controller
{
    public function eventRegistration(EventRegistrationRequest $request, Event $event)
{
    try {
        EventRegistration::create([
            'full_name' => $request->full_name,
            'email' => $request->email,
            'contact_number' => $request->contact_number,
            'event_id' => $event->id,
        ]);

        return redirect()
            ->route('event')
            ->with('success', 'Registration successful!');
    } catch (\Exception $e) {
        return back()->withErrors(['error' => $e->getMessage()]);
    }
}

    public function eventShow(Request $request)
    {
        $page_title = 'event';
        $resource = 'event';

        $query = Event::query();

        if ($request->filled('search')) {
            $query->where('title', 'like', '%' . $request->search . '%');
        }

        $data = $query->orderBy('created_at', 'desc')->paginate(8)->withQueryString();

        return view('event', compact('page_title', 'resource', 'data'));
    }

    public function index(Request $request)
    {
        $page_title = 'Event';
        $resource = 'event';

        $query = Event::query();

        if ($request->filled('search')) {
            $query->where('title', 'like', '%' . $request->search . '%');
        }

        $data = $query->orderBy('created_at', 'desc')->paginate(8)->withQueryString();

        return view('event.index', compact('page_title', 'resource', 'data'));
    }

    public function store(ProjectRequest $request)
    {
        $validated = $request->validated();

        if ($request->hasFile('file_name')) {
            $file = $request->file('file_name');
            $filename = "event" . Auth::id() . '_' . now()->format('YmdHis') . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('events'), $filename);

            $validated['file_name'] = $filename;
            $validated['file_path'] = 'events/' . $filename;
        }

        $validated['user_id'] = Auth::id();

        // Convert plain text announcement to styled HTM    L
        $announcement = $validated['announcement'] ?? '';
        $lines = explode("\n", trim($announcement));
        $html = '';

        foreach ($lines as $line) {
            if (strpos($line, ':') !== false) {
                [$label, $content] = explode(':', $line, 2);
                $html .= "<p><span class='font-semibold text-pink-600'>" . trim($label) . ":</span> " . trim($content) . "</p>\n";
            } else {
                $html .= "<p>" . trim($line) . "</p>\n";
            }
        }

        $validated['content'] = $html;
        unset($validated['announcement']);

        Event::create($validated);

        return redirect()->route('event.index')->with('success', 'Event successfully created!');
    }

    public function show(Event $event)
{
    $resource = 'event';
    $columns = ['ID', 'Full Name', 'Email', 'Contact Number'];
    $data = \App\Models\EventRegistration::where('event_id', $event->id)->get();

    return view('event.show', compact('event', 'resource', 'columns', 'data'));
}
    public function update(ProjectRequest $request, Event $event)
    {
        $validated = $request->validated();

        if ($request->hasFile('file_name')) {
            if ($event->file_path && File::exists(public_path($event->file_path))) {
                File::delete(public_path($event->file_path));
            }

            $file = $request->file('file_name');
            $filename = "event" . Auth::id() . '_' . now()->format('YmdHis') . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('events'), $filename);

            $validated['file_name'] = $filename;
            $validated['file_path'] = 'events/' . $filename;
        }

        $validated['user_id'] = Auth::id();

        $announcement = $validated['announcement'] ?? '';
        $lines = explode("\n", trim($announcement));
        $html = '';

        foreach ($lines as $line) {
            if (strpos($line, ':') !== false) {
                [$label, $content] = explode(':', $line, 2);
                $html .= "<p><span class='font-semibold text-pink-600'>" . trim($label) . ":</span> " . trim($content) . "</p>\n";
            } else {
                $html .= "<p>" . trim($line) . "</p>\n";
            }
        }

        $validated['content'] = $html;
        unset($validated['announcement']);

        $event->update($validated);

        return redirect()->route('event.index')->with('success', 'Event successfully updated!');
    }

    public function destroy(Event $event)
    {
        if ($event->file_path && File::exists(public_path($event->file_path))) {
            File::delete(public_path($event->file_path));
        }

        $event->delete();

        return redirect()->route('event.index')->with('success', 'Event successfully deleted!');
    }
}
