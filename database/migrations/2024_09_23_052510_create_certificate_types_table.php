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
        Schema::create('certificate_types', function (Blueprint $table) {
            $table->id('id_certificate_type');
            $table->string('name', 100); // Nombre del tipo de certificado (CIP, CAP, Dozer, etc.)
            $table->string('description', 100)->nullable(); // Descripción del tipo de certificado
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('certificate_types');
    }
};
