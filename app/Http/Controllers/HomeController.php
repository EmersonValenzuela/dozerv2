<?php

namespace App\Http\Controllers;

use App\Models\CertificateType;
use App\Models\Course;
use App\Models\Students;
use Illuminate\Support\Facades\File;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;

class HomeController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth')->except(['downloadFile']);
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
                'typeCertificate' => $certificateType,
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

        $typeCertificade = CertificateType::where('id_certificate_type', $course->certificate_type_id)->first();

        return view('home.course', compact('course', 'typeCertificade'));
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

    public function updateName(Request $request)
    {
        try {
            $course = Course::find($request->id);

            if (!$course) {
                throw new \Exception("El curso no fue encontrado.");
            }

            $course->course_or_event = $request->value;
            $course->save();

            return response()->json([
                'success' => true,
                'icon' => 'success',
                'message' => 'Actualización exitosa',
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'icon' => 'error',
                'message' => 'Error al actualizar: ' . $e->getMessage(),
            ]);
        }
    }


    public function updateFile(Request $request)
    {
        try {
            if (!$request->hasFile('file')) {
                throw new \Exception("No se ha recibido ningún archivo.");
            }

            $file = $request->file('file');
            $id = $request->input('id');

            $filePath = public_path('pdfs/certificates/' . $id . '.pdf');

            if (File::exists($filePath)) {
                File::delete($filePath);
            }

            $file->move(public_path('pdfs/certificates'), $id . '.pdf');
            return response()->json([
                'success' => true,
                'icon' => 'success',
                'message' => 'Archivo subido con éxito.',
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'icon' => 'error',
                'message' => 'Error al actualizar el archivo: ' . $e->getMessage(),
            ]);
        }
    }
}
