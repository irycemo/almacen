<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name' => 'Enrique',
            'email' => 'correo@correo.com',
            'email_verified_at' => Carbon::now(),
            'password' => Hash::make('12345678'),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ])->assignRole('Administrador');

        User::create([
            'name' => 'Liz',
            'email' => 'correo2@correo.com',
            'email_verified_at' => Carbon::now(),
            'password' => Hash::make('12345678'),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ])->assignRole('Delegado(a) Administrativo');

        User::create([
            'name' => 'Alejandro',
            'email' => 'correo3@correo.com',
            'email_verified_at' => Carbon::now(),
            'password' => Hash::make('12345678'),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ])->assignRole('Jefe(a) de Departamento');


        User::create([
            'name' => 'Martin',
            'email' => 'correo4@correo.com',
            'email_verified_at' => Carbon::now(),
            'password' => Hash::make('12345678'),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ])->assignRole('Jefe(a) de Departamento');

        User::create([
            'name' => 'Ana',
            'email' => 'correo5@correo.com',
            'email_verified_at' => Carbon::now(),
            'password' => Hash::make('12345678'),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ])->assignRole('Contador(a)');

        User::create([
            'name' => 'Carlos',
            'email' => 'correo6@correo.com',
            'email_verified_at' => Carbon::now(),
            'password' => Hash::make('12345678'),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ])->assignRole('Almacenista');

        User::create([
            'name' => 'Francisco',
            'email' => 'correo7@correo.com',
            'email_verified_at' => Carbon::now(),
            'password' => Hash::make('12345678'),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ])->assignRole('Almacenista');

        User::create([
            'name' => 'Jorge',
            'email' => 'correo8@correo.com',
            'email_verified_at' => Carbon::now(),
            'password' => Hash::make('12345678'),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ])->assignRole('Almacenista');

        User::create([
            'name' => 'Claudia',
            'email' => 'correo9@correo.com',
            'email_verified_at' => Carbon::now(),
            'password' => Hash::make('12345678'),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ])->assignRole('Almacenista');

        User::create([
            'name' => 'Maria',
            'email' => 'correo10@correo.com',
            'email_verified_at' => Carbon::now(),
            'password' => Hash::make('12345678'),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ])->assignRole('Almacenista');

        User::create([
            'name' => 'Juan',
            'email' => 'correo11@correo.com',
            'email_verified_at' => Carbon::now(),
            'password' => Hash::make('12345678'),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ])->assignRole('Almacenista');
    }
}
