<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreReservationRequest;
use App\Models\ClassSchedule;
use App\Models\Reservation;
use Illuminate\Support\Facades\DB;

class ReservationController extends Controller
{


    public function store(StoreReservationRequest $request)
    {
        try {

            DB::transaction(function () use ($request) {

                // Bloqueo para evitar reservas simultáneas
                $schedule = ClassSchedule::lockForUpdate()
                    ->findOrFail($request->schedule_id);


                if ($schedule->current_reservations >= $schedule->max_capacity) {
                    throw new \Exception('Esta clase acaba de llenarse.');
                }

                //Evitar duplicados (doble click o concurrencia)
                $alreadyReserved = Reservation::where('user_id', auth()->id())
                    ->where('schedule_id', $schedule->id)
                    ->exists();

                if ($alreadyReserved) {
                    throw new \Exception('Ya tienes una reserva para este horario.');
                }

                Reservation::create([
                    'user_id' => auth()->id(),
                    'schedule_id' => $schedule->id,
                ]);

                $schedule->increment('current_reservations');
            });

            return back()->with('success', 'Reserva realizada correctamente');
        } catch (\Exception $e) {

            return back()
                ->withErrors(['schedule_id' => $e->getMessage()])
                ->withInput();
        }
    }

    public function destroy(Reservation $reservation)
    {
        if ($reservation->user_id !== auth()->id()) {
            abort(403);
        }

        try {
            DB::transaction(function () use ($reservation) {

                $schedule = ClassSchedule::lockForUpdate()
                    ->findOrFail($reservation->schedule_id);

                if ($reservation->status === 'Cancelada') {
                    throw new \Exception('Esta reserva ya está cancelada.');
                }

                $reservation->update(['status' => 'Cancelada']);
                $schedule->decrement('current_reservations');
            });

            return back()->with('success', 'Reserva cancelada correctamente');
        } catch (\Exception $e) {
            return back()->withErrors(['cancel' => $e->getMessage()]);
        }
    }
}
