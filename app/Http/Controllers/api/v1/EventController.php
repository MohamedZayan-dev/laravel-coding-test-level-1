<?php

namespace App\Http\Controllers\api\v1;

use App\Http\Controllers\Controller;
use App\Models\Event;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redis;
use Illuminate\Support\Facades\Validator;

class EventController extends Controller
{
    public function getAllEvents()
    {
        $events = Event::all();
        return response()->json($events);
    }

    public function getActiveEvents(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'startAt' => 'required',
            'endAt' => 'required',
        ]);

        if ($validator->fails())
            return response()->json(['error' => $validator->errors()], 401);
        $activeEvents = Event::whereBetween('created_at', $validator->valid())->get();
        return response()->json($activeEvents);
    }

    public function getEvent($id)
    {
        $cachedEvent = Redis::get('event_' . $id);
        if (isset($cachedEvent))
            $event = json_decode($cachedEvent, FALSE);
        else{
            $event = Event::find($id);
            Redis::set('event_' . $id, $event);
        }
        return response()->json($event);
    }

    public function createEvent(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'slug' => 'required',
        ]);
        if ($validator->fails())
            return response()->json(['error' => $validator->errors()], 401);

        $event = Event::create($validator->valid());
        return response()->json($event);
    }

    public function updateOrCreateEvent(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'slug' => 'required',
        ]);
        if ($validator->fails())
            return response()->json(['error' => $validator->errors()], 401);

        $event = Event::updateOrCreate(
            ['id' =>  $id],
            $validator->valid()
        );
        return response()->json($event);
    }

    public function updateEvent(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required_without:slug',
            'slug' => 'required_without:name',
        ]);
        if ($validator->fails())
            return response()->json(['error' => $validator->errors()], 401);

        Event::find($id)->update($validator->valid());

        return response()->json(['success' => 'Event updated successfully.']);
    }

    public function deleteEvent($id)
    {
        Event::find($id)->delete();
    }
}
