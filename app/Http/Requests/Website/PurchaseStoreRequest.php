<?php

namespace App\Http\Requests\Website;

use App\Models\Card;
use App\Models\Event;
use App\Models\Purchase;
use App\Models\Ticket;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Str;

class PurchaseStoreRequest extends FormRequest
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
            'event_id' => ['required', 'integer', 'exists:events,id'],
            'ticket_id' => ['required', 'integer', 'exists:tickets,id'],
            'card_id' => ['required', 'integer', 'exists:cards,id'],
            'quantity' => ['required', 'integer', 'min:1'],
        ];
    }

    public function storePurchase()
    {
        if (! auth()->user()->cards()->get()->contains(Card::find($this->card_id))) {
            abort(403, 'You do not own this card');
        }

        if (! Ticket::find($this->ticket_id)->quantity >= $this->quantity) {
            abort(403, 'Not enough tickets available');
        }

        //payment gateway request

        $purchase = Purchase::create([
            'user_id' => auth()->id(),
            'ticket_id' => $this->ticket_id,
            'card_id' => $this->card_id,
            'quantity' => $this->quantity,
            'transaction_number' => Str::uuid(),
            'is_paid' => true,
        ]);

        if ($purchase->is_paid) {
            Ticket::find($this->ticket_id)->decrement('quantity', $this->quantity);
//     dd($purchase->id);
            auth()->user()->tickets()->attach($this->ticket_id,[
                'purchase_id' => $purchase->id,
                'serial_number' => Str::uuid(),
            ]);
        }

        return [
            'purchase' => $purchase,
            'success' => $purchase->is_paid,
        ];
    }
}
