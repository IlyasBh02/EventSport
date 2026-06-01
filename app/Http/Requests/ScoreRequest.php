<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ScoreRequest extends FormRequest
{
    public function authorize(): bool { return true; }

    public function rules(): array
    {
        return [
            'score_a' => 'required|integer|min:0',
            'score_b' => 'required|integer|min:0',
        ];
    }
}
