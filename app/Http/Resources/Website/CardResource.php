<?php

namespace App\Http\Resources\Website;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CardResource extends JsonResource
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
            'card_number' => $this->card_number,
            'card_holder' => $this->card_holder,
            'expiry_date' => $this->expiry_date,
            'cvv' => $this->cvv,
            'user' => new UserResource($this->user)
        ];
    }
}
