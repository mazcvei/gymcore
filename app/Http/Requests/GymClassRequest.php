<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class GymClassRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'trainer_id' => 'required|exists:users,id',

            'image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:4048',
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'El nombre es obligatorio.',
            'trainer_id.required' => 'Debes seleccionar un entrenador.',
            'trainer_id.exists' => 'El entrenador no es válido.',
            'image.image' => 'El archivo debe ser una imagen.',
            'image.mimes' => 'Formato no válido (jpg, png, webp).',
            'image.max' => 'La imagen no puede superar los 4MB.',
        ];
    }

    public function attributes(): array
    {
        return [
            'name' => 'nombre',
            'description' => 'descripción',
            'trainer_id' => 'entrenador',
            'image' => 'imagen',
        ];
    }
}