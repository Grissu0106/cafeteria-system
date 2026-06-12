<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        User::firstOrCreate(
            ['email' => 'admin@cafeteria.com'],
            [
                'name'     => 'Administrador',
                'password' => Hash::make('password123'),
            ]
        );

        User::firstOrCreate(
            ['email' => 'caja@cafeteria.com'],
            [
                'name'     => 'Empleado Caja',
                'password' => Hash::make('password123'),
            ]
        );
    }
}