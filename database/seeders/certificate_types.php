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
            ['name' => 'DOZER'],
            ['name' => 'CIP'],
            ['name' => 'CAP'],
            ['name' => 'Constancia de matrícula'],
            ['name' => 'Constancia de Participación'],
            ['name' => 'Reconocimiento a la excelencia'],
            ['name' => 'Participación Webinar'],
        ]);
    }
}
