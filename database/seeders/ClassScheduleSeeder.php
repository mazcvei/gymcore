<?php

namespace Database\Seeders;

use App\Models\ClassSchedule;
use App\Models\GymClass;
use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ClassScheduleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $startDate = Carbon::today();
        $endDate = Carbon::today()->addMonths(1);

        $allowedDays = [1, 3, 5]; // Lunes, Miércoles, Viernes

        $classes = GymClass::all();

        foreach ($classes as $class) {

            $currentDate = $startDate->copy();

            while ($currentDate <= $endDate) {

                if (in_array($currentDate->dayOfWeekIso, $allowedDays)) {

                    // 🔹 Turno mañana (ej: 10:00)
                    $this->createSchedule($class, $currentDate, '10:00');

                    // 🔹 Turno tarde (ej: 18:00)
                    $this->createSchedule($class, $currentDate, '18:00');
                }

                $currentDate->addDay();
            }
        }
    }

    private function createSchedule($class, $date, $startTime)
    {
        $start = Carbon::parse($date->format('Y-m-d') . ' ' . $startTime);

        $end = $start->copy()->addMinutes($class->duration);

        ClassSchedule::create([
            'class_id' => $class->id,
            'date' => $date->format('Y-m-d'),
            'start_time' => $start->format('H:i'),
            'end_time' => $end->format('H:i'),
            'max_capacity' => $class->capacity,
            'current_reservations' => 0
        ]);
    }
    
}
