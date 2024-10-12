<?php

namespace App\Http\Resources\Website;

use App\Http\Resources\Website\CategoryResourse;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class EventResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return[
            'id' => $this->id,
            'name' => $this->name,
            'categories' => CategoryResourse::collection($this->categories),
            'organizers' => OrganizerResourse::collection($this->organizers),
            'tickets' => TicketResourse::collection($this->tickets),
            'address' => $this->address,
            'time' => $this->time,
        ];
    }
}
