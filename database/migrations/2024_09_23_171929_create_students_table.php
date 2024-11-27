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
        Schema::create('students', function (Blueprint $table) {
            $table->id('id_student');
            $table->unsignedBigInteger('course_id'); // FK for certificate_types
            $table->string('code', 150)->unique()->nullable(); // Name of the course, event, or program
            $table->string('course_or_event', 200)->nullable(); // Name of the course, event, or program
            $table->string('full_name'); // Full name of the student
            $table->string('document_number'); // Document number of the student
            $table->string('score')->nullable();
            $table->string('email'); // Email address of the student
            $table->tinyInteger('c_m')->default(0); // Status of the certificate (use integers: 0, 1, 2, etc.)
            $table->tinyInteger('c_p')->default(0); // Status of the certificate (use integers: 0, 1, 2, etc.)
            $table->tinyInteger('r_e')->default(0); // Status of the certificate (use integers: 0, 1, 2, etc.)
            $table->tinyInteger('w_p')->default(0); // Status of the certificate (use integers: 0, 1, 2, etc.)
            $table->tinyInteger('certificate')->default(0); // Status of the certificate (use integers: 0, 1, 2, etc.)
            $table->enum('status', ['active', 'revoked']); // Status of the certificate
            $table->timestamps(); // Timestamps for creation and updates

            $table->foreign('course_id')->references('id_course')->on('courses')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('certificates');
    }
};
