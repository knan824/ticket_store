<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\DB;

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
            'name' => 'sometimes|string|min=8|max=50',
            'address' => 'sometimes|string|min=8|max=50',
            'time' => 'sometimes|date|date_format:Y-m-d|',
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
        });
    }
}
