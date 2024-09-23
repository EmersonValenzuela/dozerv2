<?php

use App\Http\Controllers\CertificateController;
use App\Http\Controllers\ConstancyController;
use App\Http\Controllers\EnrollmentController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\RecognitionController;
use App\Http\Controllers\WebinarController;
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
});

Route::controller(CertificateController::class)->group(function ($route) {
    Route::get('/Generar_Certificados', 'create')->name('certificate.create');
});

Route::controller(EnrollmentController::class)->group(function ($route) {
    Route::get('/Generar_Matriculas', 'create')->name('enrollment.create');
});

Route::controller(ConstancyController::class)->group(function ($route) {
    Route::get('/Generar_Constancia', 'create')->name('constancy.create');
});

Route::controller(RecognitionController::class)->group(function ($route) {
    Route::get('/Generar_Reconocimiento', 'create')->name('recognition.create');
});

Route::controller(WebinarController::class)->group(function ($route) {
    Route::get('/Generar_Constancia_Webinar', 'create')->name('webinar.create');
});
