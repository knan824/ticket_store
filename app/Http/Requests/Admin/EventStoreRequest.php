<?php

namespace App\Http\Requests\Admin;

use App\Models\Event;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\DB;

class EventStoreRequest extends FormRequest
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
            'name' => 'required|string|min:8|max:50',
            'address' => 'required|string|min:8|max:50',
            'time' => 'required|date|date_format:Y-m-d|after:today',
            'category' => 'required|array|min:1',
            'category.*' => 'integer|exists:categories,id|required_with:category',
            'organizer' => 'required|array|min:1',
            'organizer.*' => 'integer|exists:organizers,id|required_with:organizer',
            'ticket' => 'required|array|min:1',
            'ticket.*' => 'integer|exists:tickets,id|required_with:ticket',
        ];
    }

    public function storeEvent(){
        $event = Event::create($this->validated());
        $event->categories()->attach($this->category);
        $event->organizers()->attach($this->organizer);
        $event->tickets()->attach($this->ticket);

        return $event;
    }
}
