<?php

namespace App\Http\Requests;

use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ProfileUpdateRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => ['required', 'string','min:3', 'max:255'],
            'lastname' => ['nullable', 'string', 'min:3', 'max:255'],
            'email' => [
                'required',
                'string',
                'lowercase',
                'email',
                'max:255',
                Rule::unique(User::class)->ignore($this->user()->id),
            ],
            'password' => ['nullable', 'string', 'min:8', 'confirmed'],
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'El nombre es obligatorio',
            'name.min' => 'El nombre debe tener al menos 3 caracteres',

            'lastname.min' => 'El apellido debe tener al menos 3 caracteres',

            'email.required' => 'El email es obligatorio',
            'email.email' => 'El formato del email no es válido',
            'email.unique' => 'Este email ya está en uso',

            'password.confirmed' => 'Las contraseñas no coinciden',
            'password.min' => 'La contraseña debe tener al menos 8 caracteres',
        ];
    }

    public function attributes(): array
    {
        return [
            'name' => 'nombre',
            'lastname' => 'apellido',
            'email' => 'correo electrónico',
            'password' => 'contraseña',
        ];
    }

}
