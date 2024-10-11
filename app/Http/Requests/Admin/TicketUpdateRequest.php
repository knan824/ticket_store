<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\DB;

class TicketUpdateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'type' => 'sometimes|string|min:4|max:50',
            'price' => 'sometimes|integer|min:0|max:50000',
            'quantity' => 'sometimes|integer|min:1|max:100000',
        ];
    }

    public function UpdateTicket()
    {
        return DB::transaction(function () {
            $this->ticket->update([
                'type' => $this->type,
                'price' => $this->price,
                'quantity' => $this->quantity,
            ]);
        });
    }
}
