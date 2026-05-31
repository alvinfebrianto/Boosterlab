<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreAnakRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    protected function prepareForValidation(): void
    {
        $this->merge([
            'berat_lahir' => str_replace(',', '.', (string) $this->input('berat_lahir')),
            'tinggi_lahir' => str_replace(',', '.', (string) $this->input('tinggi_lahir')),
        ]);
    }

    public function rules(): array
    {
        return [
            'nama' => ['required'],
            'gender' => ['required'],
            'tanggal_lahir' => ['required', 'date'],
            'berat_lahir' => ['required', 'numeric'],
            'tinggi_lahir' => ['required', 'numeric'],
        ];
    }
}
