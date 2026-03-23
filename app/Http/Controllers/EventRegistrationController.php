<?php

namespace App\Http\Controllers;

use App\Models\EventRegistration;
use App\Models\Event;
use Illuminate\Http\Request;

class EventRegistrationController extends Controller
{
    /**
     * Display a list of all event registrations.
     */
    public function index()
    {
        $registrations = EventRegistration::with('event')->orderBy('created_at', 'desc')->paginate(10);

        return view('event_registrations.index', compact('registrations'));
    }

    /**
     * Show a single registration detail.
     */
    public function show(EventRegistration $eventRegistration)
    {
        return view('event_registrations.show', compact('eventRegistration'));
    }

    /**
     * Show form to edit a registration.
     */
    public function edit(EventRegistration $eventRegistration)
    {
        return view('event_registrations.edit', compact('eventRegistration'));
    }

    /**
     * Update a registration.
     */
    public function update(Request $request, EventRegistration $eventRegistration)
    {
        $validated = $request->validate([
            'full_name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'contact_number' => 'required|string|max:15',
        ]);

        $eventRegistration->update($validated);

        return redirect()->route('event_registrations.index')->with('success', 'Registration updated successfully.');
    }

    /**
     * Delete a registration.
     */
    public function destroy(EventRegistration $eventRegistration)
    {
        $eventRegistration->delete();

        return redirect()->route('event_registrations.index')->with('success', 'Registration deleted successfully.');
    }
}
