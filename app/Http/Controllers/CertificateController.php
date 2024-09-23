<?php

namespace App\Http\Controllers;

use App\Models\Certificates;
use App\Models\Course;
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
        ini_set('max_execution_time', 600);
        $name = $request->input('name');

        // Define the directory without 'public/'
        $directory = 'uploads/certificates';

        // Check if the directory exists and create it if it doesn't
        if (!Storage::exists($directory)) {
            Storage::makeDirectory($directory);
        }

        // Store the files
        $file1Path = $request->file('file1')->store($directory);
        $file2Path = $request->file('file2')->store($directory);

        // Get the URLs to access the files
        $img1Url = Storage::url($file1Path);
        $img2Url = Storage::url($file2Path);

        $course = new Course([
            'certificate_type_id' => $request->input('type'),
            'program_type_id' => $request->input('program'),
            'course_or_event' => $request->input('name'),
            'image_one' => $file1Path,
            'image_two' => $file2Path,
            'dateFinish' => now(),
        ]);

        $course->save();

        $courseId = $course->id_course;

        $studentsData = json_decode($request->input('rows'), true);

        foreach ($studentsData as $student) {
            $certificate = new Certificates([
                'course_id' => $courseId,
                'course_or_event' => $student['course'],
                'full_name' => $student['names'],
                'document_number' => $student['dni'],
                'score' => $student['score'],
                'email' => $student['email'],
                'issued_date' => now(),
                'status' => 'active',
            ]);
            $certificate->save();
            $id = $certificate->id_certificate;

            $prefix = floor(($id - 1) / 1000) + 2;
            $code = str_pad($prefix, 3, '0', STR_PAD_LEFT) . str_pad($id, 3, '0', STR_PAD_LEFT);
            $certificate->code = $code;
            $certificate->save();
        }

        return response()->json(['success' => true, 'icon' => 'success', 'message' => 'Pdfs Generados', 'course' => $courseId]);
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
