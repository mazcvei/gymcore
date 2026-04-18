<?php

namespace Database\Seeders;

use App\Models\GymClass;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class GymClassSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $trainer = User::with('role')->where('role_id', 2)->first(); // o crea uno específico

        $classes = [
            [
                'name' => 'Cross Training',
                'description' => 'Entrenamiento funcional de alta intensidad que combina fuerza y cardio.',
                'capacity' => 20,
                'duration' => 60,
                'image' => 'classes/crossfit.jpg'
            ],
            [
                'name' => 'Yoga Flow',
                'description' => 'Sesiones de yoga para mejorar flexibilidad, equilibrio y relajación.',
                'capacity' => 15,
                'duration' => 50,
                'image' => 'classes/yoga.jpg'
            ],
            [
                'name' => 'Spinning',
                'description' => 'Entrenamiento cardiovascular en bicicleta con música motivadora.',
                'capacity' => 25,
                'duration' => 45,
                'image' => 'classes/spinning.jpg'
            ],
            [
                'name' => 'Pilates',
                'description' => 'Ejercicios enfocados en el core, postura y control corporal.',
                'capacity' => 18,
                'duration' => 50,
                'image' => 'classes/pilates.jpg'
            ],
            [
                'name' => 'HIIT',
                'description' => 'Entrenamiento interválico de alta intensidad para quemar grasa rápidamente.',
                'capacity' => 20,
                'duration' => 30,
                'image' => 'classes/hiit.jpg'
            ],
            [
                'name' => 'Body Pump',
                'description' => 'Clases con pesas para tonificar y fortalecer todo el cuerpo.',
                'capacity' => 22,
                'duration' => 55,
                'image' => 'classes/bodypump.jpg'
            ],
            [
                'name' => 'Zumba',
                'description' => 'Entrenamiento divertido con baile y ritmos latinos.',
                'capacity' => 30,
                'duration' => 50,
                'image' => 'classes/zumba.jpg'
            ],
            [
                'name' => 'Boxeo Fitness',
                'description' => 'Entrenamiento de boxeo sin contacto para mejorar resistencia y coordinación.',
                'capacity' => 16,
                'duration' => 45,
                'image' => 'classes/boxing.jpg'
            ],
        ];

        foreach ($classes as $class) {
            GymClass::create([
                'name' => $class['name'],
                'description' => $class['description'],
                'trainer_id' => $trainer->id,
                'capacity' => $class['capacity'],
                'duration' => $class['duration'],
                'image' => $class['image'],
            ]);
        }
    }
}
