<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\EventStoreRequest;
use App\Http\Requests\Admin\EventUpdateRequest;
use App\Http\Resources\Admin\EventResource;
use App\Models\Event;

class EventController extends Controller
{
    public function __construct()
    {
        $this->authorizeResource(Event::class, 'event');
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $events = Event::with(['tickets', 'categories', 'organizers', 'image'])->paginate();

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
        $event->remove();

        return response([
            'message' => 'event removed successfully',
        ]);
    }
}
