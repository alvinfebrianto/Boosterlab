<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdatePengukuranRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    protected function prepareForValidation(): void
    {
        $this->merge([
            'berat' => str_replace(',', '.', (string) $this->input('berat')),
            'tinggi' => str_replace(',', '.', (string) $this->input('tinggi')),
        ]);
    }

    public function rules(): array
    {
        return [
            'berat' => ['required', 'numeric'],
            'tinggi' => ['required', 'numeric'],
        ];
    }
}
