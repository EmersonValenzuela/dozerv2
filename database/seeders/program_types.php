<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class program_types extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('program_types')->insert([
            ['name' => 'Curso'],
            ['name' => 'Especialización'],
            ['name' => 'Diplomado'],
        ]);
    }
}
