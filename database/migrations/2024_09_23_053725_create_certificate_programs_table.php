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
        Schema::create('certificate_programs', function (Blueprint $table) {
            $table->id('id_certificate_program');
            $table->unsignedBigInteger('id_certificate_type'); // FK de certificate_types
            $table->unsignedBigInteger('id_program_type');     // FK de program_types
            $table->timestamps();

            // Foreign Keys
            $table->foreign('id_certificate_type')->references('id_certificate_type')->on('certificate_types')->onDelete('cascade');
            $table->foreign('id_program_type')->references('id_program_type')->on('program_types')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('certificate_programs');
    }
};
