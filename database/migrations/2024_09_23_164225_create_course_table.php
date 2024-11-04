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
        Schema::create('courses', function (Blueprint $table) {
            $table->id('id_course'); // Unique course ID
            $table->string('code_course', 10)->unique()->nullable(); // FK for certificate_types
            $table->unsignedBigInteger('certificate_type_id'); // FK for certificate_types
            $table->unsignedBigInteger('program_type_id')->n; // FK for program_types
            $table->string('course_or_event', 150); // Name of the course, event, or program
            $table->string('image_one'); // Path for the first background image
            $table->string('image_two')->nullable(); // Path for the second background image
            $table->date('dateFinish')->nullable(); // Optional finish date
            $table->timestamps(); // Timestamps for creation and updates

            // Definición de las claves foráneas
            $table->foreign('certificate_type_id')->references('id_certificate_type')->on('certificate_types')->onDelete('cascade');
            $table->foreign('program_type_id')->references('id_program_type')->on('program_types')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('course');
    }
};
