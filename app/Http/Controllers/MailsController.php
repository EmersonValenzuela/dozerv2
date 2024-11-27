<?php

namespace App\Http\Controllers;

use App\Jobs\SendCertificates;
use App\Models\CertificateType;
use App\Models\Students;
use Illuminate\Http\Request;

class MailsController extends Controller
{
    public function index()
    {
        $types = CertificateType::all();
        return view('sendmail.index', compact('types'));
    }

    public function getStudentsMails(Request $request)
    {
        $students = Students::where('course_id', $request->input('course_txt'))
            ->where($request->certificate_txt, '!=', 0) // Filtrar diferente de 0
            ->get();

        $column = $request->input('column');

        // Verifica si se encontraron estudiantes
        if ($students->isEmpty()) {
            // Respuesta cuando no hay datos
            return response()->json([
                'icon' => 'warning',
                'message' => 'No se encontraron documentos generados para el filtro.',
                'data' => []
            ]);
        }

        // Si hay datos, prepara el arreglo de estudiantes
        $data = [];
        foreach ($students as $student) {
            $data[] = [
                'id' => $student->id_student,
                '' => '', // Columna vacía
                'dni' => $student->document_number,
                'names' => $student->full_name,
                'email' => $student->email,
                'code' => $student->code,
                'status' => $student->$column,
                '' => '', // Columna vacía
            ];
        }

        // Respuesta cuando hay datos
        return response()->json([
            'icon' => 'success',
            'message' => 'Estudiantes encontrados.',
            'data' => $data
        ]);
    }

    public function sendMails(Request $request)
    {
        $certificadoMap = [
            'c_m' => 'enrollments',
            'c_p' => 'constancy',
            'r_e' => 'recognition',
            'certificate' => 'certificates',
            'w_p' => 'webinar',
        ];

        $nameMap = [
            'c_m' => 'matricula_',
            'c_p' => 'constancia_participacion_',
            'r_e' => 'excelencia_',
            'certificate' => 'certificado_',
            'w_p' => 'webinar_',
        ];

        $records = $request->input('records');
        $certificado = $request->input('certificado');
        $programa = $request->input('programa');
        $viewName = $request->input('certificadoTxt');
        $sync = $viewName;
        $routeFile = $certificadoMap[$viewName] ?? null;  // Obtener la ruta
        $fileName = $nameMap[$viewName] ?? null;          // Obtener el nombre del archivo

        // Procesar el valor de certificadoTxt según la lógica
        if ($viewName == "certificate") {
            $viewName = "{$certificado}_{$programa}";
        }

        // Obtener el nombre de la vista y el nombre de archivo de certificado

        // Verificar si se han encontrado las vistas y nombres correctamente
        if (!$routeFile || !$fileName) {
            return response()->json([
                'icon' => 'error',
                'message' => 'Certificado o nombre de vista no válido.',
                'viewName' => $viewName,
                'routeFile' => $routeFile,
                'fileName' => $sync,
            ]);
        }

        // Enviar los correos con la vista específica
        foreach ($records as $record) {
            // Enviar correo
            dispatch(new SendCertificates($record, $viewName, $routeFile, $fileName));

            // Actualizar la columna correspondiente con el nombre de $viewName a 2
            $student = Students::find($record['id']);  // Encuentra el estudiante por su ID o ajusta según sea necesario
            if ($student) {
                $student->$sync = 2;  // Asigna el valor 2 a la columna correspondiente
                $student->save();  // Guarda los cambios
            }
        }

        return response()->json([
            'icon' => 'success',
            'message' => 'Correos encolados para envío',
            'records' => $records,
            'viewName' => $viewName,
            'routeFile' => $routeFile,
            'fileName' => $fileName,

        ]);
    }
}
