<?php

namespace App\Http\Controllers;

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
            ->where($request->certificate_txt, 1)
            ->get();
    
        // Verifica si se encontraron estudiantes
        if ($students->isEmpty()) {
            // Respuesta cuando no hay datos
            return response()->json([
                'icon' => 'warning',
                'message' => 'No se encontraron estudiantes para este curso y condición.',
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
    
}
