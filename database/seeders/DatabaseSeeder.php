<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // 1. Asegurar que los roles existan
        DB::table('roles')->updateOrInsert(['idRol' => 1], ['nombre' => 'Administrador']);
        DB::table('roles')->updateOrInsert(['idRol' => 2], ['nombre' => 'Cliente']);

        // 2. Crear un Administrador
        User::updateOrCreate(
            ['email' => 'admin@salon.com'],
            [
                'nombre'   => 'Admin',
                'apellido' => 'Principal',
                'password' => 'admin123',
                'FK_rol'   => 1,
            ]
        );

        // 3. Crear un Cliente
        User::updateOrCreate(
            ['email' => 'cliente@salon.com'],
            [
                'nombre'   => 'Juan',
                'apellido' => 'Perez',
                'password' => 'cliente123',
                'FK_rol'   => 2,
            ]
        );
    }
}
