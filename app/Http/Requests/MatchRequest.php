<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class MatchRequest extends FormRequest
{
    public function authorize(): bool { return true; }

    public function rules(): array
    {
        return [
            'equipe_a'   => 'required|string|max:255',
            'equipe_b'   => 'required|string|max:255',
            'date_match' => 'required|date',
        ];
    }
}
