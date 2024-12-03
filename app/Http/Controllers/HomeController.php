<?php

namespace App\Http\Controllers;

use App\Models\CertificateType;
use App\Models\Course;
use App\Models\Students;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;

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
                    $query->whereIn('c_m', [1, 2]); // Aquí filtramos por 1 o 2
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

    public function course($data)
    {
        $course = Course::where('code_course', $data)->withCount(['students' => function ($query) {
            $query->where('c_m', true);
        }])
            ->first();

        return view('home.course', compact('course'));
    }

    public function students($data)
    {

        $students = Students::getStudentByCourse($data);

        return response()->json(['data' => $students]);
    }

    public function downloadFile($data)
    {
        try {
            // Descifra los datos encriptados
            $decodedData = Crypt::decryptString($data);

            // Convierte los datos descifrados de JSON a un array
            $dataArray = json_decode($decodedData, true);

            // Construye la ruta del archivo
            $filePath = public_path('pdfs/' . $dataArray['route'] . '/' . $dataArray['name'] . $dataArray['code'] . '.pdf');

            // Verifica si el archivo existe
            if (!file_exists($filePath)) {
                abort(404, 'Archivo no encontrado');
            }

            // Forzar la descarga del archivo
            return response()->download($filePath);
        } catch (\Exception $e) {
            // Si algo falla (por ejemplo, datos manipulados), lanza un error
            abort(400, 'Datos inválidos o manipulados');
        }
    }
}
