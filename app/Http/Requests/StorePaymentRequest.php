<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorePaymentRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [

            'name_lastname' => [
                'required',
                'string',
                'max:255'
            ],

            'card_number' => [
                'required',
                'string',
                'regex:/^[0-9\s]{13,19}$/'
            ],

            'expiry' => [
                'required',
                'regex:/^(0[1-9]|1[0-2])\/\d{2}$/'
            ],

            'cvv' => [
                'required',
                'digits_between:3,4'
            ],

         
            'address' => [
                'required',
                'string',
                'max:255'
            ],
        ];
    }

    public function messages(): array
    {
        return [
            'name_lastname.required' => 'El nombre completo es obligatorio.',

            'card_number.required' => 'El número de tarjeta es obligatorio.',
            'card_number.regex' => 'El número de tarjeta no es válido.',

            'expiry.required' => 'La fecha de expiración es obligatoria.',
            'expiry.regex' => 'Formato inválido. Usa MM/AA.',

            'cvv.required' => 'El CVV es obligatorio.',
            'cvv.digits_between' => 'El CVV debe tener 3 o 4 dígitos.',

            'address.required' => 'La dirección es obligatoria.',
        ];
    }

    public function attributes(): array
    {
        return [
            'name_lastname' => 'nombre completo',
            'card_number' => 'número de tarjeta',
            'expiry' => 'fecha de expiración',
            'cvv' => 'CVV',
            'address' => 'dirección',
        ];
    }
}