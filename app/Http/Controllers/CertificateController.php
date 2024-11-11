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
        $results = Students::studentConstancy($searchTerm);

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

        $lastCourse = Course::latest('id_course')->first();
        $nextId = $lastCourse ? $lastCourse->id_course + 1 : 1;
        $codeCourse = 'C' . str_pad($nextId, 5, '0', STR_PAD_LEFT); // Ejemplo de código

        // Crear el curso
        $course = new Course([
            'certificate_type_id' => $request->input('type'),
            'program_type_id' => $request->input('program'),
            'course_or_event' => $request->input('name'),
            'image_one' => $file1Path,
            'image_two' => $file2Path,
            'dateFinish' => now(),
            'code_course' => $codeCourse, // Asignar el código al curso
        ]);

        // Guardar el curso
        $course->save();


        $courseId = $course->id_course;

        $studentsData = json_decode($request->input('rows'), true);

        foreach ($studentsData as $student) {
            $student = new Students([
                'course_id' => $courseId,
                'course_or_event' => $student['course'],
                'full_name' => $student['names'],
                'document_number' => $student['dni'],
                'score' => $student['score'],
                'email' => $student['email'],
                'status' => 'active',
            ]);
            $student->save();
            $id = $student->id_student;

            $prefix = floor(($id - 1) / 1000) + 2;
            $code = str_pad($prefix, 3, '0', STR_PAD_LEFT) . str_pad($id, 3, '0', STR_PAD_LEFT);
            $student->code = $code;
            $student->save();
        }

        return response()->json(['success' => true, 'icon' => 'success', 'message' => 'Curso Generado', 'course' => $codeCourse]);
    }


    public function generateCertificates(Request $request)
    {

        $students = json_decode($request->input('rows'), true);

        $course = Course::find($request->input('course'));
        $img1Path = Storage::url($course->image_one);
        $img2Path = Storage::url($course->image_two);

        // Itera sobre los IDs de los estudiantes
        foreach ($students as $id) {
            $student = Students::find($id);

            if ($student) {
                // Modifica el atributo 'c_m'
                $student->certificate = 1;

                // Genera el PDF pasando los datos necesarios
                $this->generatePdf($img1Path, $img2Path, $student);

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
        $pdfFileName = $code . '.pdf';
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
        $student = new Students();
        $student->course_id = $request->course_id;
        $student->full_name = $request->names;
        $student->document_number = $request->document;
        $student->email = $request->email;
        $student->score = $request->score;
        $student->course_or_event = $request->course_name;
        $student->status = "active";
        $student->save();

        $id = $student->id_student;

        $prefix = floor(($id - 1) / 1000) + 2;
        $code = str_pad($prefix, 3, '0', STR_PAD_LEFT) . str_pad($id, 3, '0', STR_PAD_LEFT);
        $student->code = $code;
        $student->save();

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

        $this->generatePdf(Storage::url($request->imgUrl), Storage::url($request->imgUrl2), $student);

        return response()->json([
            'success' => true,
            'icon' => 'success',
            'message' => 'Datos actualizados',
        ]);
    }

    public function import(Request $request)
    {
        $idCourse = $request->input('id');
        $studentsData = json_decode($request->input('rows'), true);

        foreach ($studentsData as $student) {
            // Check if a student with the same DNI and course ID already exists
            $existingStudent = Students::where('document_number', $student['dni'])
                ->where('course_id', $idCourse)
                ->first();

            if ($existingStudent) {
                // Skip this student if already exists
                continue;
            }

            // Create a new student record if it doesn't exist
            $row = new Students([
                'course_id' => $idCourse,
                'course_or_event' => $student['course'],
                'full_name' => $student['names'],
                'document_number' => $student['dni'],
                'email' => $student['email'],
                'status' => 'active',
            ]);

            $row->save();
            $id = $row->id_student;

            // Generate the code
            $prefix = floor(($id - 1) / 1000) + 2;
            $code = str_pad($prefix, 3, '0', STR_PAD_LEFT) . str_pad($id, 3, '0', STR_PAD_LEFT);
            $row->code = $code;
            $row->w_p = 1;
            $row->save();
        }

        return response()->json([
            'success' => true,
            'icon' => 'success',
            'message' => 'Alumnos ingresados',
        ]);
    }
}
