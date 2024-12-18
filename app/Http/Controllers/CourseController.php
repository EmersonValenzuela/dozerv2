<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Students;
use Illuminate\Http\Request;

class CourseController extends Controller
{

    public function search(Request $request)
    {
        $searchTerm = $request->input('query');
        $results = Course::search($searchTerm)->get();

        return response()->json($results);
    }

    public function searchCourse($type, $program)
    {
        $results = Course::where('certificate_type_id', $type)
            ->where('program_type_id', $program)
            ->get();
        return response()->json($results);
    }

    public function updateScore(Request $request)
    {
        $student = Students::find($request->id);
        $student->score = $request->score;
        $student->save();

        return response()->json([
            'success' => true,
        ]);
    }

    public function deleteStudent(Request $request)
    {
        $column = $request->certificate;

        $student = Students::find($request->id);
        $student->$column = 0;

        $pdfUrl = public_path("pdfs/" . $request->route . "/" . $request->prefix . $request->code . ".pdf");
        if (file_exists($pdfUrl)) {
            unlink($pdfUrl);
        }
        $student->save();

        return response()->json([
            'success' => true,
            'icon' => 'success',
            'message' => 'Constancia/Certificado eliminado',
        ]);
    }
}
