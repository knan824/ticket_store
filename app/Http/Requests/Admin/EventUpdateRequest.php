<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class EventUpdateRequest extends FormRequest
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
            'name' => 'sometimes|string|min:8|max:50',
            'address' => 'sometimes|string|min:8|max:50',
            'time' => 'sometimes|date|date_format:Y-m-d|after:today',
            'category' => 'sometimes|array|min:1',
            'category.*' => 'integer|exists:categories,id|required_with:category',
            'organizer' => 'sometimes|array|min:1',
            'organizer.*' => 'integer|exists:organizers,id|required_with:organizer',
            'ticket' => 'sometimes|array|min:1',
            'ticket.*' => 'integer|exists:tickets,id|required_with:ticket',
            'image' => 'sometimes|image|mimes:jpeg,png,jpg|max:2048',
        ];
    }

    public function updateEvent()
    {
        return DB::transaction(function () {
            $this->event->update([
                'name' => $this->name,
                'address' => $this->address,
                'time' => $this->time,
            ]);
            $this->event->categories()->sync($this->category);
            $this->event->organizers()->sync($this->organizer);
            $this->event->tickets()->sync($this->ticket);

            if ($this->exists('image')) {
                Storage::delete($this->event->image->path);
                $this->event->image()->delete();

                $path = $this->image->store('events');
                $this->event->image()->create([
                    'path' => $path,
                    'is_main' => true,
                    'extension' => $this->image->extension(),
                    'size' => $this->image->getSize(),
                    'type' => 'photo',
                ]);
            }

            return $this->event->refresh();
        });
    }
}
