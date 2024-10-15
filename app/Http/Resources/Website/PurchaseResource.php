<?php

namespace App\Http\Resources\Website;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PurchaseResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'event' => new EventResource($this->event),
            'quantity' => $this->quantity,
            'transaction_number' => $this->transaction_number,
            'is_paid' => $this->is_paid,
            'created_at' => $this->created_at,
        ];
    }
}
