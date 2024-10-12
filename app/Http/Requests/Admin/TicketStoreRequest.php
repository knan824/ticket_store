<?php

namespace App\Http\Requests\Admin;

use App\Models\Ticket;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\DB;

class TicketStoreRequest extends FormRequest
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
            'type' => 'required|string|min:4|max:50',
            'price' => 'required|integer|min:0|max:50000',
            'quantity' => 'required|integer|min:1|max:100000',
        ];
    }

    public function storeTicket(){
        return DB::transaction(function () {
            $ticket = Ticket::create($this->validated());

            return $ticket;
        });
    }
}
