<?php

namespace App\Http\Controllers;

use App\Models\Certificates;
use App\Models\Course;
use App\Models\Students;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CertificateController extends Controller
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
        return view('certificate.create');
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

        $directory = 'uploads/enrollments';

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

        return response()->json(['success' => true, 'icon' => 'success', 'message' => 'Curso Generado', 'course' => $courseId]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
