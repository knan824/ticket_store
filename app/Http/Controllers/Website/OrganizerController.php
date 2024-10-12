<?php

namespace App\Http\Controllers\Website;

use App\Http\Controllers\Controller;
use App\Http\Requests\Website\OrganizerStoreRequest;
use App\Http\Requests\Website\OrganizerUpdateRequest;
use App\Http\Resources\Website\OrganizerResourse;
use App\Models\Organizer;

class OrganizerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $organizers = Organizer::paginate();

        return OrganizerResourse::collection($organizers);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(OrganizerStoreRequest $request)
    {
        $organizer = $request->storeOrganizer();

        return response([
            'message' =>  'organizer stored successfully',
            'organizer' => new OrganizerResourse($organizer),
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Organizer $organizer)
    {
        return response([
            'organizer' => new OrganizerResourse($organizer),
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(OrganizerUpdateRequest $request, Organizer $organizer)
    {
        $organizer = $request->updateOrganizer();

        return response([
            'message' => 'organizer updated successfully',
            'organizer' => new OrganizerResourse($organizer),
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Organizer $organizer)
    {
        $organizer->delete();

        return response([
            'message' => 'organizer removed successfully',
        ]);
    }
}
