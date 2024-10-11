<?php

namespace App\Http\Requests\Admin;

use App\Models\Organizer;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\DB;

class OrganizerStoreRequest extends FormRequest
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
        ];
    }

    public function storeOrganizer(){
        return DB::transaction(function () {
            $organizer = Organizer::create($this->validated());

            return $organizer;
        });
    }
}
