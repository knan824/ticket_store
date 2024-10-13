<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class OrganizerUpdateRequest extends FormRequest
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
            'name' => 'sometimes|string|min:3|max:50|unique:organizers,name',
            'image' => 'sometimes|image|mimes:jpeg,png,jpg|max:2048',
        ];
    }

    public function updateOrganizer()
    {
        return DB::transaction(function () {
            $this->organizer->update([
                'name' => $this->name,
            ]);

            if ($this->exists('image')) {
                Storage::delete($this->organizer->image->path);
                $this->organizer->image()->delete();

                $path = $this->image->store('organizers');
                $this->organizer->image()->create([
                    'path' => $path,
                    'is_main' => true,
                    'extension' => $this->image->extension(),
                    'size' => $this->image->getSize(),
                    'type' => 'photo',
                ]);
            }
            return $this->organizer->refresh();
        });
    }
}
