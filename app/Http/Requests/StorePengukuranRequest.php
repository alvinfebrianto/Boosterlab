<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorePengukuranRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'berat' => ['required', 'numeric'],
            'tinggi' => ['required', 'numeric'],
        ];
    }
}
