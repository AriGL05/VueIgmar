<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Carrera;
use App\Models\Materia;
use App\Models\User;
use App\Models\Alumno;
use App\Models\Maestro;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $carrera1 = Carrera::create(['name' => 'Ing Sistemas','enfoque' => 'Area de Tic']);
        $carrera2 = Carrera::create(['name' => 'Ing Civil','enfoque' => 'Politicas']);
        // Add more Carreras as needed
        
        // Insert Materias for each Carrera
        $materia1 = Materia::create(['name' => 'Base de Datos','unidades' => '4', 'carrera_id' => $carrera1->id]);
        $materia2 = Materia::create(['name' => 'IoT', 'unidades' => '3','carrera_id' => $carrera1->id]);
        $materia3 = Materia::create(['name' => 'Diseño','unidades' => '3', 'carrera_id' => $carrera1->id]);
        $materia4 = Materia::create(['name' => 'Politica','unidades' => '5', 'carrera_id' => $carrera2->id]);

        $user1 = User::create([
            'name' => 'Ariadna Loera',
            'email' => 'ari@example.com',
            'password' => Hash::make('password'), 
        ]);

        $alumno1 = Alumno::create([
            'name' => 'Ana',
            'lastname'=>'Laura',
            'genero' => 'F',
            'carrera_id' => $carrera1->id
        ]);
        $maestro1 = Maestro::create([
            'name' => 'Ana',
            'lastname'=>'Laura',
            'genero' => 'F',
            'email' => 'ana@example.com',
            'materia_id' => $materia3->id
        ]);
        
    }
}
