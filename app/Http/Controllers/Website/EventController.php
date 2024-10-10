<?php

namespace App\Http\Controllers\Website;

use App\Http\Controllers\Controller;
use App\Http\Requests\Website\EventStoreRequest;
use App\Http\Requests\Website\EventUpdateRequest;
use App\Http\Resources\Website\EventResource;
use App\Models\Event;

class EventController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $events = Event::paginate();

        return EventResource::collection($events);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(EventStoreRequest $request)
    {
        $event = $request->storeEvent();

        return response([
            'message' =>  'event stored successfully',
            'event' => new EventResource($event),
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Event $event)
    {
        return response([
            'event' => new EventResource($event),
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(EventUpdateRequest $request, Event $event)
    {
        $event = $request->updateEvent();

        return response([
            'message' => 'event updated successfully',
            'event' => new EventResource($event),
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Event $event)
    {
        $event->delete();

        return response([
            'message' => 'event removed successfully',
        ]);
    }
}
