<?php

namespace App\Http\Controllers;

use App\Models\Course;
use Illuminate\Http\Request;

class CourseController extends Controller
{

    public function search(Request $request)
    {
        $searchTerm = $request->input('query');
        $results = Course::search($searchTerm)->get();

        return response()->json($results);
    }
}
