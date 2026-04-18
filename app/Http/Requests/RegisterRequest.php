<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Password;

class RegisterRequest extends FormRequest
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
            'name' => ['required', 'string','min:3', 'max:255'],
            'lastname' => ['required', 'string','min:3', 'max:255'],

            'email' => [
                'required',
                'string',
                'email',
                'max:255',
                'unique:users,email',
            ],

            'phone' => [
                'nullable',
                'string',
                'max:20',
                'regex:/^[0-9+\-\s]*$/',
            ],

            'password' => [
                'required',
                'confirmed',
                Password::min(6),
            ],
        ];
    }

     public function messages(): array
    {
        return [
            'name.required' => 'El nombre es obligatorio',
            'lastname.required' => 'El apellido es obligatorio',

            'email.required' => 'El email es obligatorio',
            'email.email' => 'El email no es válido',
            'email.unique' => 'Este email ya está registrado',

            'phone.regex' => 'El teléfono solo puede contener números y símbolos válidos',

            'password.required' => 'La contraseña es obligatoria',
            'password.confirmed' => 'Las contraseñas no coinciden',
            'password.min' => 'La contraseña debe tener al menos 6 caracteres',
        ];
    }

    public function attributes(): array
    {
        return [
            'name' => 'nombre',
            'lastname' => 'apellido',
            'email' => 'correo electrónico',
            'phone' => 'teléfono',
            'password' => 'contraseña',
        ];
    }
}
