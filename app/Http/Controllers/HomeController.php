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
            // Filtra los cursos usando el 'id_certificate_type'
            $courses = Course::where('certificate_type_id', $certificateType->id_certificate_type)->get();

            return view('home.list')->with('courses', $courses);
        } else {
            // Si no se encontró la categoría, puedes manejarlo mostrando un mensaje o redirigiendo
            return redirect()->back()->with('error', 'Categoría no encontrada.');
        }
    }
}
