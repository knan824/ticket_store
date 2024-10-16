<?php

namespace App\Http\Resources\Admin;

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
            'ticket'=> new TicketResourse($this->ticket),
            'quantity' => $this->quantity,
            'transaction_number' => $this->transaction_number,
            'is_paid' => $this->is_paid,
            'created_at' => $this->created_at,
        ];
    }
}
