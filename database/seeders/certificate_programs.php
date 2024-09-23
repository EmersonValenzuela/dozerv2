<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class certificate_programs extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('certificate_programs')->insert([

            ['id_certificate_type' => 1, 'id_program_type' => 1],
            ['id_certificate_type' => 1, 'id_program_type' => 2],
            ['id_certificate_type' => 1, 'id_program_type' => 3],
            // CIP
            ['id_certificate_type' => 2, 'id_program_type' => 2],
            ['id_certificate_type' => 2, 'id_program_type' => 3],
            // CAP
            ['id_certificate_type' => 3, 'id_program_type' => 2],
            ['id_certificate_type' => 3, 'id_program_type' => 3],

            //Constancia de matrícula
            ['id_certificate_type' => 4, 'id_program_type' => 1],
            ['id_certificate_type' => 4, 'id_program_type' => 2],
            ['id_certificate_type' => 4, 'id_program_type' => 3],
            //Constancia de participación
            ['id_certificate_type' => 5, 'id_program_type' => 1],
            ['id_certificate_type' => 5, 'id_program_type' => 2],
            ['id_certificate_type' => 5, 'id_program_type' => 3],
            //Reconocimiento a la excelencia
            ['id_certificate_type' => 6, 'id_program_type' => 1],
            ['id_certificate_type' => 6, 'id_program_type' => 2],
            ['id_certificate_type' => 6, 'id_program_type' => 3],
            //Participación Webinar
            ['id_certificate_type' => 7, 'id_program_type' => 1],
            ['id_certificate_type' => 7, 'id_program_type' => 2],
            ['id_certificate_type' => 7, 'id_program_type' => 3],

        ]);
    }
}
