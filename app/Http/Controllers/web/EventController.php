<?php

namespace App\Http\Controllers\web;

use App\Http\Controllers\Controller;
use App\Models\Event;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Session;

class EventController extends Controller
{
    public function getPaginatedEvents()
    {
        $events = Event::paginate(4);
        return view('events.index')->with('events', $events);
    }

    public function getEvent($id)
    {
        $event = Event::find($id);
        return view('events.single')->with('event', $event);
    }

    public function getEventCreatePage()
    {
        return view('events.create');
    }

    public function createEvent(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required',
            'slug' => 'required',
        ]);
        Event::create($validated);
        return redirect('/event/create')->with(["success" => "Event was created successfully"]);
    }

    public function getEventEditPage($id)
    {
        $event = Event::find($id);
        return view('events.edit')->with('event', $event);
    }

    public function editEvent(Request $request, $id)
    {
        $validated = $request->validate([
            'name' => 'required_without:slug',
            'slug' => 'required_without:name',
        ]);
        Event::find($id)->update($validated);
        return redirect('/events/' . $id . '/edit')->with(["success" => "Event updated successfully"]);
    }
    public function deleteEvent(Request $request, $id)
    {
        Event::find($id)->delete();
        return redirect('/events')->with(["success" => "Event was deleted successfully"]);
    }
}
