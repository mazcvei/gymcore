<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
       
        \App\Models\User::updateOrCreate(['email' => 'admin@admin.com'],[
            'name' => 'Admin User',
            'email' => 'admin@admin.com',
            'role_id' => Role::where('name', 'admin')->first()->id,
            'password' => Hash::make('password'),
        ]);

        \App\Models\User::updateOrCreate(['email' => 'member@member.com'],[
            'name' => 'Member User',
            'email' => 'member@member.com',
            'role_id' => Role::where('name', 'member')->first()->id,
            'password' => Hash::make('password'),
        ]);

         \App\Models\User::updateOrCreate(['email' => 'trainer@trainer.com'],[
            'name' => 'Trainer User',
            'email' => 'trainer@trainer.com',
            'role_id' => Role::where('name', 'trainer')->first()->id,
            'password' => Hash::make('password'),
        ]);
         \App\Models\User::updateOrCreate(['email' => 'trainer2@trainer.com'],[
            'name' => 'Trainer 2 User',
            'email' => 'trainer2@trainer.com',
            'role_id' => Role::where('name', 'trainer')->first()->id,
            'password' => Hash::make('password'),
        ]);

    }
}
