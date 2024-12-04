<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class certificate_types extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('certificate_types')->insert([
            ['name' => 'DOZER', 'description' => 'INSTITUTO DOZER'],
            ['name' => 'CIP', 'description' => 'COLEGIO DE INGENIEROS DEL PERÚ'],
            ['name' => 'CAP', 'description' => 'COLEGIO DE ARQUITECTOS DEL PERÚ'],
            ['name' => 'Constancia de matrícula', 'description' => null],
            ['name' => 'Constancia de Participación', 'description' => null],
            ['name' => 'Reconocimiento a la excelencia', 'description' => null],
            ['name' => 'Participación Webinar', 'description' => null],
        ]);
    }
}
