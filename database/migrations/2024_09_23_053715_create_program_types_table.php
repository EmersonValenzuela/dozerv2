<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('program_types', function (Blueprint $table) {
            $table->id('id_program_type');
            $table->string('name', 100); // Nombre del tipo de programa (Curso, Especialización, Diplomado)
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('program_types');
    }
};
