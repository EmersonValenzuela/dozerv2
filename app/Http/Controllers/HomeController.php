<?php

namespace App\Http\Controllers;

use App\Models\CertificateType;
use App\Models\Course;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        return view('home');
    }

    public function list($category)
    {
        // Busca el ID de la categoría en la tabla 'certificate_types'
        $certificateType = CertificateType::where('name', $category)->first();

        // Verifica si se encontró la categoría
        if ($certificateType) {
            // Obtén los tipos de programas asociados al tipo de certificado
            $programTypes = $certificateType->programTypes()->get();

            // Filtra los cursos por el tipo de certificado y cuenta solo los estudiantes cuyo c_m sea true
            $courses = Course::where('certificate_type_id', $certificateType->id_certificate_type)
                ->withCount(['students' => function ($query) {
                    $query->where('c_m', true);
                }])
                ->get();

            return view('home.list')->with([
                'courses' => $courses,
                'programTypes' => $programTypes
            ]);
        } else {
            return redirect()->back()->with('error', 'Categoría no encontrada.');
        }
    }

    public function course($course)
    {

        return view('home.course');
    }
}
