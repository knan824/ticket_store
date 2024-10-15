<?php

namespace App\Http\Requests\Website;

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
            'description' => 'required|string|min:1|max:200',
            'category' => 'required|array|min:1',
            'category.*' => 'integer|exists:categories,id|required_with:category',
            'organizer' => 'required|array|min:1',
            'organizer.*' => 'integer|exists:organizers,id|required_with:organizer',
            'ticket' => 'required|array|min:1',
            'ticket.*' => 'integer|exists:tickets,id|required_with:ticket',
            'image' => 'required|image|mimes:jpeg,png,jpg|max:2048',
        ];
    }

    public function storeEvent(){
        return DB::transaction(function () {
            $event = Event::create($this->validated());
            $event->categories()->attach($this->category);
            $event->organizers()->attach($this->organizer);
            $event->tickets()->attach($this->ticket);

            $path = $this->image->store('events');
            $event->image()->create([
                'path' => $path,
                'is_main' => true,
                'extension' => $this->image->extension(),
                'size' => $this->image->getSize(),
                'type' => 'photo',
            ]);

            return $event;
        });
    }
}
