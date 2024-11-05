<?php

use App\Http\Controllers\CertificateController;
use App\Http\Controllers\ConstancyController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\EnrollmentController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProgramController;
use App\Http\Controllers\RecognitionController;
use App\Http\Controllers\WebinarController;
use App\Models\ProgramType;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::controller(HomeController::class)->group(function ($route) {
    Route::get('/', 'index')->name('home');
    Route::get('/Lista/{category}', 'list')->name('home.list');
    Route::get('/Curso/{data}', 'course')->name('home.course');
    Route::get('/Curso/{data}/students', 'students');
});

Route::controller(CertificateController::class)->group(function ($route) {
    Route::get('/Crear_Curso', 'create')->name('certificate.create');
    Route::post('/insertCertificates', 'store');
});

Route::controller(EnrollmentController::class)->group(function ($route) {
    Route::get('/Generar_Matriculas', 'create')->name('enrollment.create');
    Route::post('/scopeStudent', 'searchStudents');
    Route::post('/generateEnrollments', 'store');
    Route::get('/pdfEnrollment/{id}', 'show');
});

Route::controller(ConstancyController::class)->group(function ($route) {
    Route::get('/Generar_Constancia', 'create')->name('constancy.create');
    Route::post('/scopeStudentConstancy', 'searchStudents');
    Route::get('/pdfConstancy/{id}', 'show');
    Route::post('/generateConstancy', 'store');
});

Route::controller(RecognitionController::class)->group(function ($route) {
    Route::get('/Generar_Reconocimiento', 'create')->name('recognition.create');
    Route::get('/pdfRecognition/{id}', 'show');
    Route::post('/generateRecognition', 'store');
});

Route::controller(WebinarController::class)->group(function ($route) {
    Route::get('/Lista_Webinar', 'index')->name('webinar.index');
    Route::get('/Webinar/{code}', 'webinar')->name('webinar.show');
    Route::get('/Generar_Constancia_Webinar', 'create')->name('webinar.create');
    Route::post('/insertWebinar', 'store');
    Route::get('/pdfWebinar/{id}', 'show');
    Route::get('/Webinar/{data}/students', 'students');
});

Route::controller(ProgramController::class)->group(function ($route) {
    Route::get('/get-programs/{certificateType}', 'getPrograms');
});

Route::controller(CourseController::class)->group(function ($route) {
    Route::get('/scopeCoruse', 'search');
});
