<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateAnakRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'nama' => ['required'],
            'gender' => ['required'],
            'tanggal_lahir' => ['required', 'date'],
        ];
    }
}
