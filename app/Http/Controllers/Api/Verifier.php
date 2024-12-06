<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Students;
use Illuminate\Http\Request;

class Verifier extends Controller
{
    public function certified(Request $request, $code)
    {
        // Mapeo de prefijos a rutas y prefijos de archivo
        $mapRoute = [
            'CIP-E-' => ['route' => 'certificates', 'prefix' => 'certificado_'],
            'CIP-D-' => ['route' => 'certificates', 'prefix' => 'certificado_'],
            'CAP-E-' => ['route' => 'certificates', 'prefix' => 'certificado_'],
            'CAP-D-' => ['route' => 'certificates', 'prefix' => 'certificado_'],
            'EXC-'  => ['route' => 'recognition', 'prefix' => 'excelencia_'],
        ];

        // Separar el código en prefijo y sufijo
        if (preg_match('/^([A-Za-z\-]+)(\d+)$/', $code, $matches)) {
            $prefijo = $matches[1];  // Letras y guion
            $sufijo = $matches[2];   // Número

;

            // Buscar al estudiante por el código del sufijo
            $student = Students::where('code', $sufijo)->first();

            if (!$student) {
                return response()->json([
                    'error' => 'Estudiante no encontrado'
                ], 404);
            }

            // Determinar la ruta y el prefijo
            $route = '';
            $prefix = '';

            if (in_array($prefijo, ['DO-C-', 'DO-E-', 'DO-D-'])) {
                // Prefijos para 'DO-'
                if ($student->certificate == 1) {
                    $route = 'certificates';
                    $prefix = 'certificado_';
                } elseif ($student->c_p == 1) {
                    $route = 'constancy';
                    $prefix = 'constancia_';
                } else {
                    return response()->json([
                        'error' => 'No se encontró un certificado o constancia para este estudiante.'
                    ], 400);
                }
            } else {
                // Usar el mapeo para prefijos predefinidos
                $route = $mapRoute[$prefijo]['route'] ?? null;
                $prefix = $mapRoute[$prefijo]['prefix'] ?? '';

                if (!$route) {
                    return response()->json([
                        'error' => 'Prefijo no válido'
                    ], 400);
                }
            }

            // Generar URL del documento
            $documentUrl = url("pdfs/{$route}/{$prefix}{$sufijo}.pdf");

            // Respuesta con datos del estudiante
            return response()->json([
                'status' => 'success',
                'names' => $student->full_name,
                'course' => $student->course_or_event,
                'document' => $student->document_number,
                'route' => $route,
                'prefijo' => $prefijo,
                'sufijo' => $sufijo,
                'url' => $documentUrl,
            ]);
        }

        // Código no válido
        return response()->json([
            'error' => 'Código no válido'
        ], 400);
    }
}
