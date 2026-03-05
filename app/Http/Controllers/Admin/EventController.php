<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Event;
use Illuminate\Http\Request;

class EventController extends Controller
{
    public function dashboard()
    {
        $events = Event::withCount('registrations')->latest()->get();
        return view('admin.dashboard', compact('events'));
    }

    public function index()
    {
        $events = Event::withCount('registrations')->latest()->get();
        return view('admin.events.index', compact('events'));
    }

    public function create()
    {
        return view('admin.events.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'speaker' => 'required|string|max:255',
            'location' => 'required|string|max:255',
            'total_seats' => 'required|integer|min:1',
        ]);

        Event::create($validated);
        return redirect()->route('admin.events.index')->with('success', 'สร้างกิจกรรมสำเร็จ');
    }

    public function show(string $id)
    {
        $event = Event::with('registrations.user')->findOrFail($id);
        return view('admin.events.show', compact('event'));
    }

    public function edit(string $id)
    {
        $event = Event::findOrFail($id);
        return view('admin.events.edit', compact('event'));
    }

    public function update(Request $request, string $id)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'speaker' => 'required|string|max:255',
            'location' => 'required|string|max:255',
            'total_seats' => 'required|integer|min:1',
        ]);

        $event = Event::findOrFail($id);
        $event->update($validated);
        return redirect()->route('admin.events.index')->with('success', 'อัปเดตกิจกรรมสำเร็จ');
    }

    public function destroy(string $id)
    {
        $event = Event::findOrFail($id);
        $event->delete();
        return redirect()->route('admin.events.index')->with('success', 'ลบกิจกรรมสำเร็จ');
    }
}
