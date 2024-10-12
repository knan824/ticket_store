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
        ];
    }

    public function storeEvent(){
        return DB::transaction(function () {
            $event = Event::create($this->validated());

            return $event;
        });
    }
}
