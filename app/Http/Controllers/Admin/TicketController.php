<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\TicketStoreRequest;
use App\Http\Requests\Admin\TicketUpdateRequest;
use App\Http\Resources\Admin\TicketResourse;
use App\Models\Ticket;

class TicketController extends Controller
{
    public function __construct()
    {
        $this->authorizeResource(Ticket::class, 'ticket');
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $tickets = Ticket::paginate();

        return TicketResourse::collection($tickets);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(TicketStoreRequest $request)
    {
        $ticket = $request->storeTicket();

        return response([
            'message' =>  'ticket stored successfully',
            'ticket' => new TicketResourse($ticket),
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Ticket $ticket)
    {
        return response([
            'ticket' => new TicketResourse($ticket),
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(TicketUpdateRequest $request, Ticket $ticket)
    {
        $ticket = $request->updateTicket();

        return response([
            'message' => 'ticket updated successfully',
            'ticket' => new TicketResourse($ticket),
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Ticket $ticket)
    {
        $ticket->delete();

        return response([
            'message' => 'ticket removed successfully',
        ]);
    }
}
