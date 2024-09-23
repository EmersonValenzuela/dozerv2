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
            $table->string('document_number'); // Full name of the student
            $table->string('score');
            $table->string('email'); // Email address of the student
            $table->boolean('c_m')->default(false); // Status of the certificate
            $table->boolean('c_p')->default(false); // Status of the certificate
            $table->boolean('r_e')->default(false); // Status of the certificate
            $table->boolean('w_p')->default(false); // Status of the certificate
            $table->boolean('certificate')->default(false); // Status of the certificate
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
