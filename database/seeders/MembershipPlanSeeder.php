<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\MembershipPlan;

class MembershipPlanSeeder extends Seeder
{
    public function run(): void
    {
        $plans = [

            [
                'name' => 'Prueba',
                'price' => 0,
                'description' => '1 día de acceso completo al gimnasio',
                'duration_days' => 1,
                'is_popular' => false,
                'features' => json_encode([
                    'Acceso a instalaciones',
                    'Clases disponibles',
                    'Sin compromiso'
                ])
            ],

            [
                'name' => '1 Mes',
                'price' => 35,
                'description' => 'Acceso completo durante 1 mes',
                'duration_days' => 30,
                'is_popular' => false,
                'features' => json_encode([
                    'Acceso ilimitado',
                    'Reservar clases',
                    'Soporte incluido'
                ])
            ],

            [
                'name' => '3 Meses',
                'price' => 99,
                'description' => 'Ahorra con un plan trimestral',
                'duration_days' => 90,
                'is_popular' => true,
                'features' => json_encode([
                    'Acceso ilimitado',
                    'Reservar clases',
                    'Descuento incluido'
                ])
            ],

            [
                'name' => '1 Año',
                'price' => 300,
                'description' => 'La mejor opción para entrenar todo el año',
                'duration_days' => 365,
                'is_popular' => false,
                'features' => json_encode([
                    'Acceso ilimitado',
                    'Reservas prioritarias',
                    'Mayor ahorro'
                ])
            ],
        ];

        foreach ($plans as $plan) {
            MembershipPlan::create($plan);
        }
    }
}