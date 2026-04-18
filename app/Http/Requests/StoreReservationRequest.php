<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Models\ClassSchedule;

class StoreReservationRequest extends FormRequest
{
    public function authorize(): bool
    {
        // Solo usuarios autenticados pueden reservar
        return auth()->check();
    }

    public function rules(): array
    {
        return [
            'schedule_id' => [
                'required',
                'exists:class_schedules,id',
            ],
        ];
    }

    public function messages(): array
    {
        return [
            'schedule_id.required' => 'Debes seleccionar un horario.',
            'schedule_id.exists' => 'El horario seleccionado no es válido.',
        ];
    }

    public function withValidator($validator)
    {
        $validator->after(function ($validator) {

            $schedule = ClassSchedule::find($this->schedule_id);

            if (!$schedule) {
                return;
            }

            $dateTime = \Carbon\Carbon::parse(
                $schedule->date . ' ' . $schedule->start_time
            );

            if ($dateTime->isPast()) {
                $validator->errors()->add(
                    'schedule_id',
                    'No puedes reservar una clase que ya ha comenzado.'
                );
            }

            // Evita aforo completo
            if ($schedule->current_reservations >= $schedule->max_capacity) {
                $validator->errors()->add(
                    'schedule_id',
                    'Esta clase ya está completa.'
                );
            }

            // 🔴 3. Evitar doble reserva del mismo usuario
            $alreadyReserved = $schedule->reservations()
                ->where('user_id', auth()->id())
                ->exists();

            if ($alreadyReserved) {
                $validator->errors()->add(
                    'schedule_id',
                    'Ya tienes una reserva para este horario.'
                );
            }
        });
    }
}