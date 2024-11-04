<?php

namespace App\Http\Controllers;

use App\Models\CertificateType;
use App\Models\Course;
use App\Models\Students;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

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


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
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
            'course_or_event' => $request->input('name'),
            'image_one' => $file1Path,
            'dateFinish' => now(),
            'code_course' => $codeCourse, // Asignar el código al curso
        ]);

        $course->save();

        $courseId = $course->id_course;

        $studentsData = json_decode($request->input('rows'), true);

        foreach ($studentsData as $student) {
            $student = new Students([
                'course_id' => $courseId,
                'course_or_event' => $student['course'],
                'full_name' => $student['names'],
                'document_number' => $student['dni'],
                'email' => $student['email'],
                'status' => 'active',
            ]);
            $student->save();
            $id = $student->id_student;

            $prefix = floor(($id - 1) / 1000) + 2;
            $code = str_pad($prefix, 3, '0', STR_PAD_LEFT) . str_pad($id, 3, '0', STR_PAD_LEFT);
            $student->code = $code;
            $student->w_p = 1;
            $student->save();

            $this->generatePdf($student['names'], $student['course'], $request->input('date'), $imgUrl, $code);
        }
        return response()->json([
            'success' => true,
            'icon' => 'success',
            'message' => 'Constancias generadas',
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

        $pdfFileName = $code . '.pdf';
        $pdf->Output(public_path('pdfs/webinar/' . $pdfFileName), 'F');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
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
