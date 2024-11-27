<?php

namespace App\Http\Controllers;

use App\Models\Certificates;
use App\Models\Course;
use App\Models\Students;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

require(public_path('fpdf/fpdf.php'));


class CertificateController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('certificate.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('certificate.create');
    }

    public function searchStudents(Request $request)
    {
        $searchTerm = $request->input('course');
        $results = Students::studentCertificate($searchTerm);

        return response()->json($results);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Obtener el último curso y calcular el próximo ID
        $lastCourse = Course::latest('id_course')->first();
        $nextId = $lastCourse ? $lastCourse->id_course + 1 : 1;
        $codeCourse = 'C' . str_pad($nextId, 5, '0', STR_PAD_LEFT); // Generar código del curso

        // Crear el curso
        $course = new Course([
            'certificate_type_id' => $request->input('type'),
            'program_type_id' => $request->input('program'),
            'course_or_event' => $request->input('name'),
            'dateFinish' => now(),
            'code_course' => $codeCourse, // Asignar el código al curso
        ]);

        // Guardar el curso
        $course->save();

        $courseId = $course->id_course;

        // Obtener los datos de los estudiantes
        $studentsData = json_decode($request->input('rows'), true);

        foreach ($studentsData as $studentData) {
            // Contar cuántos estudiantes hay en el curso actualmente
            $currentStudentCount = Students::where('course_id', $courseId)->count();

            // Crear el estudiante
            $student = new Students([
                'course_id' => $courseId,
                'course_or_event' => $request->input('name'),
                'full_name' => $studentData['names'],
                'document_number' => $studentData['dni'],
                'score' => $studentData['score'],
                'email' => $studentData['email'],
                'status' => 'active',
            ]);
            $student->save();

            // Generar el código del estudiante
            $coursePrefix = str_pad($courseId, 3, '0', STR_PAD_LEFT);
            $studentNumber = str_pad($currentStudentCount + 1, 3, '0', STR_PAD_LEFT);
            $studentCode = $coursePrefix . $studentNumber;

            // Actualizar el código del estudiante
            $student->code = $studentCode;
            $student->save();
        }

        return response()->json(['success' => true, 'icon' => 'success', 'message' => 'Curso Generado', 'course' => $codeCourse]);
    }



    public function generateCertificates(Request $request)
    {

        // Define the directory without 'public/'
        $directory = 'uploads/certificates';

        // Verifica si el directorio existe y lo crea si no, dentro de 'public/'
        if (!Storage::disk('public')->exists($directory)) {
            Storage::disk('public')->makeDirectory($directory);
        }

        // Store the files
        $file1Path = $request->file('file1')->store($directory, 'public');
        $file2Path = $request->file('file2')->store($directory, 'public');

        // Get the URLs to access the files
        $img1Url = Storage::url($file1Path);
        $img2Url = Storage::url($file2Path);

        $course = Course::find($request->input('course'));
        $course->image_one = $img1Url;
        $course->image_two = $img2Url;
        $course->save();


        $students = json_decode($request->input('rows'), true);

        // Itera sobre los IDs de los estudiantes
        foreach ($students as $id) {
            $student = Students::find($id);

            if ($student) {
                // Modifica el atributo 'c_m'
                $student->certificate = 1;

                // Genera el PDF pasando los datos necesarios
                $this->generatePdf($img1Url, $img2Url, $student);

                // Guarda los cambios en el estudiante
                $student->save();
            }
        }

        return response()->json([
            'success' => true,
            'icon' => 'success',
            'message' => 'Certificados generados',
        ]);
    }

    public function generatePdf($img1, $img2, $student)
    {
        $name = $student->full_name;
        $code = $student->code;
        $course = $student->course_or_event;
        $score = $student->score;

        $pdf = new \FPDF('L', 'mm', 'A4');
        $pdf->AddPage();

        $anchoPagina = $pdf->GetPageWidth();
        $altoPagina = $pdf->GetPageHeight();

        // Página 1: Imagen y texto
        $pdf->Image(public_path($img1), 0, 0, $anchoPagina, $altoPagina);

        $pdf->AddFont('Oswald-Regular', '', 'Oswald-VariableFont_wght.php');
        $pdf->AddFont('Oswald-Bold', '', 'Oswald-Bold.php');
        $pdf->AddFont('Oswald-Medium', '', 'Oswald-Medium.php');

        $pdf->SetFont('Oswald-Regular', '', 11);
        $pdf->SetTextColor(117, 117, 117);
        $pdf->SetXY(27.1, 28.4);
        $pdf->Cell(1, 35, $code, 0, 1, 'L');

        // Configurar para centrar el texto
        $pdf->SetFont('Oswald-Bold', '', 22);
        $pdf->SetTextColor(0, 0, 0);

        $anchoTexto = $pdf->GetStringWidth($name);
        $x = ($anchoPagina - $anchoTexto) / 2;
        $pdf->SetXY($x, 45); // Ajustar la posición vertical según sea necesario
        $pdf->Cell($anchoTexto, 40, $name, '', 1, 'C', false);

        $pdf->SetFont('Oswald-Medium', '', 22);
        $pdf->SetTextColor(0, 0, 0);

        $anchoTexto = $pdf->GetStringWidth($course);
        $x = ($anchoPagina - $anchoTexto) / 2;
        $pdf->SetXY($x, 70); // Ajustar la posición vertical según sea necesario
        $pdf->Cell($anchoTexto, 40, utf8_decode($course), '', 1, 'C', false);


        $pdf->SetFont('Oswald-Regular', '', 12);
        $pdf->SetTextColor(117, 117, 117);
        $pdf->SetXY(210, 177);
        $pdf->Cell(1, 5, $code, 0, 1, 'L');

        $pdf->AddPage('L');
        $pdf->SetFont('times', '', 12);

        // Página 2: Imagen y texto
        $pdf->Image(public_path($img2), 0, 0, $anchoPagina, $altoPagina);
        $pdf->SetFont('Oswald-Bold', '', 20);
        $pdf->SetTextColor(255, 255, 255);
        $pdf->SetXY(249.8, 43);
        $pdf->Cell(1, 5, $score, 0, 1, 'C');


        $pdf->SetFont('Oswald-Regular', '', 12);
        $pdf->SetTextColor(117, 117, 117);
        $pdf->SetXY(209.5, 176.7);
        $pdf->Cell(1, 5, $code, 0, 1, 'L');

        // Guardar el archivo PDF en una carpeta específica dentro del proyecto
        $pdfFileName = "certificado_" . $code . '.pdf';
        $pdf->Output(public_path('pdfs/certificates/' . $pdfFileName), 'F');
    }

    public function example($id)
    {


        $img1 = "img/backgrounds/img1.png";
        $img2 = "img/backgrounds/img2.png";
        $name = "Marlon Valenzuela Estrada";
        $code = "0745147";
        $course = "Panaderia Nuclear";
        $score = "20";

        $pdf = new \FPDF('L', 'mm', 'A4');
        $pdf->AddPage();

        $anchoPagina = $pdf->GetPageWidth();
        $altoPagina = $pdf->GetPageHeight();

        // Página 1: Imagen y texto
        $pdf->Image(public_path($img1), 0, 0, $anchoPagina, $altoPagina);

        $pdf->AddFont('Oswald-Regular', '', 'Oswald-VariableFont_wght.php');
        $pdf->AddFont('Oswald-Bold', '', 'Oswald-Bold.php');
        $pdf->AddFont('Oswald-Medium', '', 'Oswald-Medium.php');

        $pdf->SetFont('Oswald-Regular', '', 11);
        $pdf->SetTextColor(117, 117, 117);
        $pdf->SetXY(27.1, 28.4);
        $pdf->Cell(1, 35, $code, 0, 1, 'L');

        // Configurar para centrar el texto
        $pdf->SetFont('Oswald-Bold', '', 22);
        $pdf->SetTextColor(0, 0, 0);

        $anchoTexto = $pdf->GetStringWidth($name);
        $x = ($anchoPagina - $anchoTexto) / 2;
        $pdf->SetXY($x, 45); // Ajustar la posición vertical según sea necesario
        $pdf->Cell($anchoTexto, 40, $name, '', 1, 'C', false);

        $pdf->SetFont('Oswald-Medium', '', 22);
        $pdf->SetTextColor(0, 0, 0);

        $anchoTexto = $pdf->GetStringWidth($course);
        $x = ($anchoPagina - $anchoTexto) / 2;
        $pdf->SetXY($x, 70); // Ajustar la posición vertical según sea necesario
        $pdf->Cell($anchoTexto, 40, utf8_decode($course), '', 1, 'C', false);


        $pdf->SetFont('Oswald-Regular', '', 12);
        $pdf->SetTextColor(117, 117, 117);
        $pdf->SetXY(210, 177);
        $pdf->Cell(1, 5, $code, 0, 1, 'L');

        $pdf->AddPage('L');
        $pdf->SetFont('times', '', 12);

        // Página 2: Imagen y texto
        $pdf->Image(public_path($img2), 0, 0, $anchoPagina, $altoPagina);
        $pdf->SetFont('Oswald-Bold', '', 20);
        $pdf->SetTextColor(255, 255, 255);
        $pdf->SetXY(249.8, 43);
        $pdf->Cell(1, 5, $score, 0, 1, 'C');


        $pdf->SetFont('Oswald-Regular', '', 12);
        $pdf->SetTextColor(117, 117, 117);
        $pdf->SetXY(209.5, 176.9);
        $pdf->Cell(1, 5, $code, 0, 1, 'L');

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
        $student->score = $request->score;
        $student->course_or_event = $request->course_name;
        $student->status = "active";
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
        $student->score = $request->score;
        $student->course_or_event = $request->course_name;
        $student->certificate = 1;
        $student->save();

        $this->generatePdf($request->imgUrl, $request->imgUrl2, $student);

        return response()->json([
            'success' => true,
            'icon' => 'success',
            'message' => 'Datos actualizados',
        ]);
    }

    public function import(Request $request)
    {
        $idCourse = $request->input('id');

        $course = Course::find($idCourse);
        $studentsData = json_decode($request->input('rows'), true);

        foreach ($studentsData as $student) {
            // Busca si ya existe un estudiante con el mismo DNI y ID de curso
            $existingStudent = Students::where('document_number', $student['dni'])
                ->where('course_id', $idCourse)
                ->first();

            if ($existingStudent) {
                // Si el estudiante ya existe, actualiza sus datos
                $existingStudent->full_name = $student['names'];
                $existingStudent->email = $student['email'];
                $existingStudent->score = $student['score'];
                $existingStudent->save();
            } else {
                // Contar cuántos estudiantes hay en el curso actualmente
                $currentStudentCount = Students::where('course_id', $idCourse)->count();

                // Crea un nuevo registro de estudiante si no existe
                $newStudent = new Students([
                    'course_id' => $idCourse,
                    'course_or_event' => $course->course_or_event,
                    'full_name' => $student['names'],
                    'document_number' => $student['dni'],
                    'email' => $student['email'],
                    'score' => $student['score'],
                    'status' => 'active',
                ]);

                $newStudent->save();

                // Genera el código del estudiante
                $coursePrefix = str_pad($idCourse, 3, '0', STR_PAD_LEFT);
                $studentNumber = str_pad($currentStudentCount + 1, 3, '0', STR_PAD_LEFT);
                $studentCode = $coursePrefix . $studentNumber;

                $newStudent->code = $studentCode;
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
}
