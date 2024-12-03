<?php

namespace App\Http\Controllers;

use App\Models\CertificateType;
use App\Models\Course;
use App\Models\Students;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rules\Exists;

require(public_path('fpdf/fpdf.php'));

class WebinarController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $category = 'Participación Webinar';
        // Busca el ID de la categoría en la tabla 'certificate_types'
        $certificateType = CertificateType::where('name', $category)->first();

        // Verifica si se encontró la categoría
        if ($certificateType) {
            // Filtra los cursos por el tipo de certificado y cuenta solo los estudiantes cuyo c_m sea true
            $courses = Course::where('certificate_type_id', $certificateType->id_certificate_type)
                ->withCount('students') // Cuenta todos los estudiantes sin condiciones
                ->get();

            return view('webinar.index')->with([
                'courses' => $courses,
            ]);
        } else {
            return redirect()->back()->with('error', 'Categoría no encontrada.');
        }
    }

    public function create()
    {
        return view('webinar.create');
    }

    public function webinar($code)
    {
        $course = Course::where('code_course', $code)
            ->withCount('students') // Cuenta todos los estudiantes sin condiciones
            ->first();

        return view('webinar.show', compact('course'));
    }

    public function store(Request $request)
    {
        $directory = 'uploads/webinar'; // Define el directorio donde se guardarán los archivos.

        if (!Storage::disk('public')->exists($directory)) {
            Storage::disk('public')->makeDirectory($directory);
        }

        $file1Path = $request->file('file1')->store($directory, 'public');
        $imgUrl = Storage::url($file1Path);

        $lastCourse = Course::latest('id_course')->first();
        $nextId = $lastCourse ? $lastCourse->id_course + 1 : 1;
        $codeCourse = 'W' . str_pad($nextId, 5, '0', STR_PAD_LEFT); // Ejemplo de código

        // Crear el curso
        $course = new Course([
            'certificate_type_id' => 7,
            'program_type_id' => 1,
            'course_or_event' => $request->input('name'),
            'image_one' => $file1Path,
            'dateFinish' => now(),
            'code_course' => $codeCourse, // Asignar el código al curso
        ]);

        $course->save();

        $courseId = $course->id_course;

        // Obtener los estudiantes enviados en el request
        $studentsData = json_decode($request->input('rows'), true);

        foreach ($studentsData as $student) {
            $student = new Students([
                'course_id' => $courseId,
                'course_or_event' =>  $request->input('name'),
                'full_name' => $student['names'],
                'document_number' => $student['dni'],
                'email' => $student['email'],
                'status' => 'active',
            ]);
            $student->save();
            $id = $student->id_student;

            // Contar cuántos estudiantes hay en el curso actualmente
            $currentStudentCount = Students::where('course_id', $courseId)->count();

            // Genera el código del estudiante
            $coursePrefix = str_pad($courseId, 3, '0', STR_PAD_LEFT);
            $studentNumber = str_pad($currentStudentCount, 3, '0', STR_PAD_LEFT);
            $studentCode = $coursePrefix . $studentNumber;

            $student->code = $studentCode;
            $student->w_p = 1;
            $student->save();

            // Generar PDF para cada estudiante
            $this->generatePdf($student->full_name, $student->course_or_event, $request->input('date'), $imgUrl, $studentCode);
        }

        return response()->json([
            'success' => true,
            'icon' => 'success',
            'message' => 'Constancias generadas',
            'course' => $codeCourse
        ]);
    }


    public function import(Request $request)
    {
        $idCourse = $request->input('id');
        $studentsData = json_decode($request->input('rows'), true);

        foreach ($studentsData as $student) {
            // Busca si ya existe un estudiante con el mismo DNI y ID de curso
            $existingStudent = Students::where('document_number', $student['dni'])
                ->where('course_id', $idCourse)
                ->first();

            if ($existingStudent) {
                // Si el estudiante ya existe, actualiza sus datos
                $existingStudent->course_or_event = $student['course'];
                $existingStudent->full_name = $student['names'];
                $existingStudent->email = $student['email'];
                $existingStudent->status = 'active';
                $existingStudent->w_p = 1;
                $existingStudent->save();
            } else {
                // Crea un nuevo registro de estudiante si no existe
                $newStudent = new Students([
                    'course_id' => $idCourse,
                    'course_or_event' => $student['course'],
                    'full_name' => $student['names'],
                    'document_number' => $student['dni'],
                    'email' => $student['email'],
                    'status' => 'active',
                ]);

                $newStudent->save();
                $id = $newStudent->id_student;

                // Cálculo del código del estudiante
                // Genera un número secuencial dentro del curso basado en el ID del curso
                $coursePrefix = str_pad($idCourse, 3, '0', STR_PAD_LEFT); // Formato del curso
                $studentCount = Students::where('course_id', $idCourse)->count(); // Contador de estudiantes en el curso
                $studentNumber = str_pad($studentCount, 3, '0', STR_PAD_LEFT); // Formato secuencial para el estudiante

                // El código del estudiante será algo como '001002' (donde 001 es el código del curso y 002 es el número secuencial)
                $studentCode = $coursePrefix . $studentNumber;

                $newStudent->code = $studentCode; // Asigna el código generado al estudiante
                $newStudent->w_p = 1;
                $newStudent->save();
            }
        }

        return response()->json([
            'success' => true,
            'icon' => 'success',
            'message' => 'Alumnos ingresados o actualizados',
        ]);
    }


    public function generatePdf($name, $course, $date, $img1, $code)
    {

        $pdf = new \FPDF('L', 'mm', 'A4');
        $pdf->AddPage();

        $anchoPagina = $pdf->GetPageWidth();
        $altoPagina = $pdf->GetPageHeight();

        // Página 1: Imagen y texto
        $pdf->Image(public_path($img1), 0, 0, $anchoPagina, $altoPagina);

        $pdf->AddFont('Oswald-Regular', '', 'Oswald-VariableFont_wght.php');
        $pdf->AddFont('Oswald-Bold', '', 'Oswald-Bold.php');
        $pdf->AddFont('Oswald-Medium', '', 'Oswald-Medium.php');
        $pdf->AddFont('Oswald-Light', '', 'Oswald-Light.php');

        // Configurar para centrar el texto
        $pdf->SetFont('Oswald-Bold', '', 21);
        $pdf->SetTextColor(0, 0, 0);

        $anchoTexto = $pdf->GetStringWidth($name);
        $x = ($anchoPagina - $anchoTexto) / 2;
        $pdf->SetXY($x, 68); // Ajustar la posición vertical según sea necesario
        $pdf->Cell($anchoTexto, 40,  utf8_decode($name), '', 1, 'C', false);

        $pdf->SetFont('Oswald-Medium', '', 19);
        $pdf->SetTextColor(0, 0, 0);

        $anchoTexto = $pdf->GetStringWidth($course);
        $x = ($anchoPagina - $anchoTexto) / 2;
        $pdf->SetXY($x, 95); // Ajustar la posición vertical según sea necesario
        $pdf->Cell($anchoTexto, 40, utf8_decode($course), '', 1, 'C', false);

        $anchoTexto = $pdf->GetStringWidth($date);
        $x = ($anchoPagina - $anchoTexto) / 2;
        $pdf->SetFont('Oswald-Light', '', 14);
        $pdf->SetTextColor(127, 128, 128); // color #7f8080
        $pdf->SetXY($x, 108.5); // Ajustar la posición vertical según sea necesario
        $pdf->Cell($anchoTexto, 40, utf8_decode($date), 0, 1, 'C');

        $pdfFileName = "webinar_" . $code . '.pdf';
        $pdf->Output(public_path('pdfs/webinar/' . $pdfFileName), 'F');
    }

    public function show($id)
    {
        $img1 = "img/examples/webinar.png";

        $name = "Antonella Perez Rodriguez";
        $code = "0745147";
        $course = "Nombre del Webinar";
        $date = "Realizado el 17 de marzo del 2024 con una duración de 120 min.";

        $pdf = new \FPDF('L', 'mm', 'A4');
        $pdf->AddPage();

        $anchoPagina = $pdf->GetPageWidth();
        $altoPagina = $pdf->GetPageHeight();

        // Página 1: Imagen y texto
        $pdf->Image(public_path($img1), 0, 0, $anchoPagina, $altoPagina);

        $pdf->AddFont('Oswald-Regular', '', 'Oswald-VariableFont_wght.php');
        $pdf->AddFont('Oswald-Bold', '', 'Oswald-Bold.php');
        $pdf->AddFont('Oswald-Medium', '', 'Oswald-Medium.php');
        $pdf->AddFont('Oswald-Light', '', 'Oswald-Light.php');

        // Configurar para centrar el texto
        $pdf->SetFont('Oswald-Bold', '', 21);
        $pdf->SetTextColor(0, 0, 0);

        $anchoTexto = $pdf->GetStringWidth($name);
        $x = ($anchoPagina - $anchoTexto) / 2;
        $pdf->SetXY($x, 68); // Ajustar la posición vertical según sea necesario
        $pdf->Cell($anchoTexto, 40, $name, '', 1, 'C', false);

        $pdf->SetFont('Oswald-Medium', '', 19);
        $pdf->SetTextColor(0, 0, 0);

        $anchoTexto = $pdf->GetStringWidth($course);
        $x = ($anchoPagina - $anchoTexto) / 2;
        $pdf->SetXY($x, 95); // Ajustar la posición vertical según sea necesario
        $pdf->Cell($anchoTexto, 40, utf8_decode($course), '', 1, 'C', false);

        $anchoTexto = $pdf->GetStringWidth($date);
        $x = ($anchoPagina - $anchoTexto) / 2;
        $pdf->SetFont('Oswald-Light', '', 14);
        $pdf->SetTextColor(127, 128, 128); // color #7f8080
        $pdf->SetXY($x, 108.5); // Ajustar la posición vertical según sea necesario
        $pdf->Cell($anchoTexto, 40, utf8_decode($date), 0, 1, 'C');

        // Guardar el archivo PDF en una carpeta específica dentro del proyecto
        $pdf->Output();
    }

    public function insertStudent(Request $request)
    {
        // Crear un nuevo estudiante
        $student = new Students();
        $student->course_id = $request->course_id;
        $student->full_name = $request->names;
        $student->document_number = $request->document;
        $student->email = $request->email;
        $student->course_or_event = $request->webinar;
        $student->w_p = 1;
        $student->save();

        // Obtener el ID del curso
        $courseId = $request->course_id;

        // Contar cuántos estudiantes hay ya en ese curso
        $studentCount = Students::where('course_id', $courseId)->count();

        // Generar el código del estudiante
        $coursePrefix = str_pad($courseId, 3, '0', STR_PAD_LEFT); // Formato del curso con 3 dígitos
        $studentNumber = str_pad($studentCount, 3, '0', STR_PAD_LEFT); // Número secuencial del estudiante en el curso

        $studentCode = $coursePrefix . $studentNumber; // Código final

        // Asignar y guardar el código del estudiante
        $student->code = $studentCode;
        $student->save();

        // Generar PDF para el estudiante
        $this->generatePdf($request->names, $request->webinar, $request->date_webinar, Storage::url($request->imgUrl), $studentCode);

        // Responder con un mensaje de éxito
        return response()->json([
            'success' => true,
            'icon' => 'success',
            'message' => 'Alumno creado',
        ]);
    }


    public function updateStudent(Request $request)
    {
        $student = students::find($request->student_id);
        $student->full_name = $request->names;
        $student->document_number = $request->document;
        $student->email = $request->email;
        $student->course_or_event = $request->webinar;
        $student->w_p = 1;
        $student->save();


        $this->generatePdf($request->names, $request->webinar, $request->date_webinar, Storage::url($request->imgUrl), $request->code);
        return response()->json([
            'success' => true,
            'icon' => 'success',
            'message' => 'Datos actualizados',
        ]);
    }


    public function students($data)
    {

        $students = Students::getStudentByWebinar($data);

        return response()->json(['data' => $students]);
    }

    public function deleteStudent($data)
    {
        $student = Students::find($data);

        if (!$student) {
            return response()->json([
                'success' => false,
                'icon' => 'error',
                'message' => 'Estudiante no encontrado',
            ]);
        }

        $pdfUrl = public_path("pdfs/webinar/webinar_" . $student->code . ".pdf");

        // Verificar si el archivo existe y eliminarlo
        if (file_exists($pdfUrl)) {
            unlink($pdfUrl);
        }

        $student->delete();

        return response()->json([
            'success' => true,
            'icon' => 'success',
            'message' => 'Alumno eliminado',
        ]);
    }
}
