<?php

namespace App\Http\Controllers;

use App\Models\CertificateProgram;
use Illuminate\Http\Request;

class ProgramController extends Controller
{
    public function getPrograms($certificateType)
    {
        $programs = CertificateProgram::with('programType')
            ->where('id_certificate_type', $certificateType) // Cambia 'certificate_type_id' a 'id_certificate_type'
            ->get();

        return response()->json($programs);
    }
}
