<?php

namespace App\Http\Resources\Admin;

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
            'address' => $this->address,
            'time' => $this->time,
            'description' => $this->description,
            'categories' => CategoryResourse::collection($this->categories),
            'organizers' => OrganizerResourse::collection($this->organizers),
            'tickets' => TicketResourse::collection($this->tickets),
            'image' => ImageResource::make($this->image),
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
