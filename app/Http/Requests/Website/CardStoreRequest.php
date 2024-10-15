<?php

namespace App\Http\Requests\Website;

use App\Models\Card;
use Illuminate\Foundation\Http\FormRequest;

class CardStoreRequest extends FormRequest
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
            'card_number' => ['required', 'string', 'min:10', 'max:25'],
            'card_holder' => ['required', 'string', 'min:10', 'max:30'],
            'expiry_date' => ['required', 'date', 'date_format:Y-m-d', 'after:today'],
            'cvv' => ['required', 'string', 'max:3'],
        ];
    }

    public function storeCard()
    {
        return Card::create([
            'user_id' => auth()->id(),
            'card_number' => $this->card_number,
            'card_holder' => $this->card_holder,
            'expiry_date' => $this->expiry_date,
            'cvv' => $this->cvv,
        ]);
    }
}
