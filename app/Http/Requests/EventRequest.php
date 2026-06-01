<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EventRequest extends FormRequest
{
    public function authorize(): bool { return true; }

    public function rules(): array
    {
        return [
            'name'          => 'required|string|max:255',
            'lieu'          => 'required|string|max:255',
            'date'          => 'required|date|after:now',
            'capacite_max'  => 'required|integer|min:1',
            'sport_type_id' => 'required|exists:sport_types,id',
            'description'   => 'nullable|string',
        ];
    }
}
