<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Centro;
use App\Models\Estudiante;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        // 1. Crear los 6 Centros
        $centros = [
            ['codigo' => 'C-01', 'nombre' => 'Centro Base Fidel Castro Ruiz', 'maestros' => 13, 'estado' => 'Sincronizado'],
            ['codigo' => 'C-02', 'nombre' => 'Escuela Guastomate', 'maestros' => 3, 'estado' => 'Sincronizado'],
            ['codigo' => 'C-03', 'nombre' => 'Centro El Malinche', 'maestros' => 4, 'estado' => 'Pendiente'],
            ['codigo' => 'C-04', 'nombre' => 'Escuela Santa Marta', 'maestros' => 3, 'estado' => 'Sincronizado'],
            ['codigo' => 'C-05', 'nombre' => 'Centro José Dolores Rivera', 'maestros' => 4, 'estado' => 'Sincronizado'],
            ['codigo' => 'C-06', 'nombre' => 'Escuela Huberto Amador Mendez', 'maestros' => 2, 'estado' => 'Pendiente']
        ];

        foreach ($centros as $centro) {
            Centro::create($centro);
        }

        // 2. Crear Estudiantes de prueba
        Estudiante::create([
            'codigo_mined' => 'MIN-1001', 'nombre_completo' => 'María López', 'edad' => 14, 
            'sexo' => 'Femenino', 'centro_id' => 1, 'grado' => '3ro Secundaria', 'modalidad' => 'Matutino'
        ]);
        Estudiante::create([
            'codigo_mined' => 'MIN-1002', 'nombre_completo' => 'Carlos Martínez', 'edad' => 6, 
            'sexo' => 'Masculino', 'centro_id' => 2, 'grado' => '1ro Primaria', 'modalidad' => 'Matutino'
        ]);
    }
}