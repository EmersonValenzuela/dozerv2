<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Students;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

require(public_path('fpdf/fpdf.php'));

class EnrollmentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('enrollment.create');
    }

    public function searchStudents(Request $request)
    {
        $searchTerm = $request->input('course');
        $results = Students::studentEnrollment($searchTerm);

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
        $directory = 'uploads/enrollments'; // Define el directorio donde se guardarán los archivos.

        if (!Storage::disk('public')->exists($directory)) {
            Storage::disk('public')->makeDirectory($directory);
        }

        $file1Path = $request->file('file1')->store($directory, 'public');

        $imgUrl = Storage::url($file1Path);

        $students = json_decode($request->input('rows'), true);

        $course = Course::find($request->input('course'));
        $course->image_cm = $imgUrl;
        $course->save();

        // Itera sobre los IDs de los estudiantes
        foreach ($students as $id) {
            $student = Students::find($id);

            if ($student) {
                // Modifica el atributo 'c_m'
                $student->c_m = 1;

                // Genera el PDF pasando los datos necesarios
                $this->generatePdf($student->full_name, $student->course_or_event, $request->input('date'), $imgUrl, $student->code);

                // Guarda los cambios en el estudiante
                $student->save();
            }
        }

        return response()->json([
            'success' => true,
            'icon' => 'success',
            'message' => 'Constancias generadas y estudiantes actualizados',
        ]);
    }

    public function generatePdf($names, $course, $date, $img, $code)
    {

        $pdf = new \FPDF('L', 'mm', 'A4');
        $pdf->AddPage();

        $anchoPagina = $pdf->GetPageWidth();
        $altoPagina = $pdf->GetPageHeight();

        // Página 1: Imagen y texto
        $pdf->Image(public_path($img), 0, 0, $anchoPagina, $altoPagina);

        $pdf->AddFont('Oswald-Regular', '', 'Oswald-VariableFont_wght.php');
        $pdf->AddFont('Oswald-Bold', '', 'Oswald-Bold.php');
        $pdf->AddFont('Oswald-Medium', '', 'Oswald-Medium.php');
        $pdf->AddFont('Oswald-Light', '', 'Oswald-Light.php');

        // Configurar para centrar el texto
        $pdf->SetFont('Oswald-Bold', '', 22);
        $pdf->SetTextColor(0, 0, 0);

        $anchoTexto = $pdf->GetStringWidth($names);
        $x = ($anchoPagina - $anchoTexto) / 2;
        $pdf->SetXY($x, 70); // Ajustar la posición vertical según sea necesario
        $pdf->Cell($anchoTexto, 40, utf8_decode($names), '', 1, 'C', false);

        $pdf->SetFont('Oswald-Medium', '', 21);
        $pdf->SetTextColor(0, 0, 0);

        $anchoTexto = $pdf->GetStringWidth($course);
        $x = ($anchoPagina - $anchoTexto) / 2;
        $pdf->SetXY($x, 98); // Ajustar la posición vertical según sea necesario
        $pdf->Cell($anchoTexto, 40, utf8_decode($course), '', 1, 'C', false);

        $pdf->SetFont('Oswald-Light', '', 13);
        $pdf->SetTextColor(127, 128, 128);
        $pdf->SetXY(179.5, 120.2);
        $pdf->Cell(1, 35, utf8_decode($date), 0, 1, 'L');

        $pdfFileName = 'matricula_' . $code . '.pdf';
        $pdf->Output(public_path('pdfs/enrollments/') . $pdfFileName, 'F');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $img1 = "img/examples/enrollment.png";
        $name = "Antonella Perez Rodriguez";
        $date = "14 de julio del 2024";
        $course = "Nombre del Curso modular";

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
        $pdf->SetFont('Oswald-Bold', '', 22);
        $pdf->SetTextColor(0, 0, 0);

        $anchoTexto = $pdf->GetStringWidth($name);
        $x = ($anchoPagina - $anchoTexto) / 2;
        $pdf->SetXY($x, 70); // Ajustar la posición vertical según sea necesario
        $pdf->Cell($anchoTexto, 40, utf8_decode($name), '', 1, 'C', false);

        $pdf->SetFont('Oswald-Medium', '', 21);
        $pdf->SetTextColor(0, 0, 0);

        $anchoTexto = $pdf->GetStringWidth($course);
        $x = ($anchoPagina - $anchoTexto) / 2;
        $pdf->SetXY($x, 98); // Ajustar la posición vertical según sea necesario
        $pdf->Cell($anchoTexto, 40, utf8_decode($course), '', 1, 'C', false);

        $pdf->SetFont('Oswald-Light', '', 14);

        $pdf->SetTextColor(127, 128, 128);

        $pdf->SetXY(179.5, 120.1);
        $pdf->Cell(1, 35, $date, 0, 1, 'L');

        $pdf->Output();
    }

    public function updateStudent(Request $request)
    {
        // Buscar el estudiante por su ID
        $student = students::find($request->student_id);

        // Verificar si el estudiante existe
        if (!$student) {
            return response()->json([
                'success' => false,
                'icon' => 'error',
                'message' => 'Estudiante no encontrado',
            ], 404);
        }

        // Actualizar los datos del estudiante
        $student->full_name = $request->names;
        $student->document_number = $request->document;
        $student->email = $request->email;
        $student->score = $request->score;
        $student->course_or_event = $request->course_name;
        $student->save();

        // Verificar si la URL de la imagen está presente
        if (empty($request->imgUrl)) {
            return response()->json([
                'success' => false,
                'icon' => 'warning',
                'message' => 'Se actualizo, Pero aun no se genera PDF (Falta Imagen)',
            ], 400);
        }

        // Generar el PDF
        $this->generatePdf($request->names, $request->course_name, $request->course_date, $request->imgUrl, $request->code);
        $student->c_m = 1;
        $student->save();
        // Responder con éxito
        return response()->json([
            'success' => true,
            'icon' => 'success',
            'message' => 'Datos actualizados',
        ]);
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
