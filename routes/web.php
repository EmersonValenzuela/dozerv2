<?php

use App\Http\Controllers\CertificateController;
use App\Http\Controllers\ConstancyController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\EnrollmentController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\MailsController;
use App\Http\Controllers\PasswordResetController;
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

Route::controller(LoginController::class)->group(function ($route) {
    Route::get('/', 'index')->name('home');
    Route::get('/login', 'login')->name('login');
    Route::get('/lista-usuarios', 'list')->name('user.index');
    Route::post('/auth-user', 'authUser');
    Route::get('/user-list', 'userList');
    Route::post('/insertUser', 'insertUser');
    Route::post('/updateUser', 'updateUser');
    Route::get('/logout', 'logout')->name('logout');
    Route::post('/deleteUser/{id}', 'deleteUser');

    Route::get('recuperar-contraseña', 'recover')->name('recover');
    Route::post('recover-password', 'validateMail')->name('verified');
    Route::get('Confirmacion', 'confirm')->name('confirm');
});

Route::controller(PasswordResetController::class)->group(function ($route) {
    Route::get('/reset-password/{token}', 'showResetForm')->name('reset.password');
    Route::post('/reset-password/change', 'resetPassword');
});



Route::middleware('auth:sanctum')->group(function () {
    Route::controller(HomeController::class)->group(function ($route) {
        Route::get('/Lista/{category}', 'list')->name('home.list');
        Route::get('/Curso/{data}', 'course')->name('home.course');
        Route::get('/Curso/{data}/students', 'students');
        Route::post('/Curso/updateName', 'updateName');
        Route::post('Curso/uploadFile', 'updateFile');
        Route::get('/documento/{data}', 'downloadFile')->name('home.certificate');
    });

    Route::controller(CertificateController::class)->group(function ($route) {
        Route::get('/Crear_Curso', 'create')->name('certificate.create');
        Route::post('/insertCertificates', 'store');
        Route::get('/Generar_Certificados', 'index')->name('certificate.index');
        Route::get('/pdfCourse/{id}', 'example');
        Route::post('addStudent', 'insertStudent');
        Route::post('/scopeStudentCertificate', 'searchStudents');
        Route::post('/generateCertificates', 'generateCertificates');
        Route::post('/mStudent', 'updateStudent');
        Route::post('/Certificate/import', 'import');
    });

    Route::controller(EnrollmentController::class)->group(function ($route) {
        Route::get('/Generar_Matriculas', 'create')->name('enrollment.create');
        Route::post('/scopeStudent', 'searchStudents');
        Route::post('/generateEnrollments', 'store');
        Route::get('/pdfEnrollment/{id}', 'show');
        Route::post('cmStudent', 'updateStudent');
    });

    Route::controller(ConstancyController::class)->group(function ($route) {
        Route::get('/Generar_Constancia', 'create')->name('constancy.create');
        Route::post('/scopeStudentConstancy', 'searchStudents');
        Route::get('/pdfConstancy/{id}', 'show');
        Route::post('/generateConstancy', 'store');
        Route::post('/cpStudent', 'updateStudent');
    });

    Route::controller(RecognitionController::class)->group(function ($route) {
        Route::get('/Generar_Reconocimiento', 'create')->name('recognition.create');
        Route::get('/pdfRecognition/{id}', 'show');
        Route::post('/generateRecognition', 'store');
        Route::post('reStudent', 'updateStudent');
        Route::post('scopeStudentRecognition', 'searchStudents');
    });

    Route::controller(WebinarController::class)->group(function ($route) {
        Route::get('/Lista_Webinar', 'index')->name('webinar.index');
        Route::get('/Webinar/{code}', 'webinar')->name('webinar.show');
        Route::get('/Generar_Constancia_Webinar', 'create')->name('webinar.create');
        Route::post('/insertWebinar', 'store');
        Route::get('/pdfWebinar/{id}', 'show');
        Route::get('/Webinar/{data}/students', 'students');
        Route::post('/Webinar/deleteStudentWebinar/{data}', 'deleteStudent');
        Route::post('/Webinar/insertStudentWebinar', 'insertStudent');
        Route::post('/Webinar/updateStudentWebinar', 'updateStudent');
        Route::post('/Webinar/importwebinar', 'import');
    });

    Route::controller(ProgramController::class)->group(function ($route) {
        Route::get('/get-programs/{certificateType}', 'getPrograms');
    });

    Route::controller(CourseController::class)->group(function ($route) {
        Route::get('/scopeCoruse', 'search');
        Route::get('/get-courses/{type}/{program}', 'searchCourse');
        Route::post('/students/{id}/update-score', 'updateScore');
        Route::post('/StudentCourse/delete', 'deleteStudent');
    });

    Route::controller(MailsController::class)->group(function ($route) {
        Route::get('/Enviar_correos', 'index')->name('sendmail.index');
        Route::post('/get-students-mails', 'getStudentsMails');
        Route::post('/sendMails', 'sendMails');
    });
});
