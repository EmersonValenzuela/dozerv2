<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Students;
use Illuminate\Http\Request;

class Verifier extends Controller
{
    public function certified(Request $request, $code)
    {
        $mapRoute = [
            'CIP-E' => ['route' => 'certificates', 'prefix' => 'certificado_'],
            'CIP-D' => ['route' => 'certificates', 'prefix' => 'certificado_'],
            'CAP-E' => ['route' => 'certificates', 'prefix' => 'certificado_'],
            'CAP-D' => ['route' => 'certificates', 'prefix' => 'certificado_'],
            'EXC-' => ['route' => 'recognition', 'prefix' => 'excelencia_'],
        ];

        // Variable para almacenar la ruta
        $route = '';
        $prefix = '';

        // Separar el código en prefijo y sufijo
        if (preg_match('/^([A-Za-z\-]+)(\d+)$/', $code, $matches)) {
            $prefijo = $matches[1];  // El prefijo (letras y guion)
            $sufijo = $matches[2];   // El número

            // Buscar al estudiante por el código del sufijo
            $student = Students::where('code', $sufijo)->first();

            // Verificar si el estudiante existe
            if (!$student) {
                return response()->json([
                    'error' => 'Estudiante no encontrado'
                ], 404);
            }

            // Asignar la ruta en función del prefijo
            if (in_array($prefijo, ['DO-C-', 'DO-E-', 'DO-D-'])) {
                // Verificar las condiciones específicas para los prefijos 'DO-'
                if ($student->certificate == 1) {
                    $route = 'certificates';
                    $prefix = 'certificado_';
                } elseif ($student->c_p == 1) {
                    $route = 'constancy';
                    $prefix = 'constancia_';
                }
            } else {
                // Usar el mapeo para asignar la ruta
                $route = $mapRoute[$prefijo]['route'] ?? null;
                $prefix = $mapRoute[$prefijo]['prefix'];

                // Verificar si se encontró una ruta válida
                if (!$route) {
                    return response()->json([
                        'error' => 'Prefijo no válido'
                    ], 400);
                }
            }

            // Devolver respuesta con los detalles
            return response()->json([
                'status' => 'success',
                'names' => $student->full_name,
                'course' => $student->course_or_event,
                'document' => $student->document_number,
                'route' => $route,
                'prefijo' => $prefijo,
                'sufijo' => $sufijo,
                'url' => url('pdfs/' . $route . '/' . $prefix . $sufijo . '.pdf'),
            ]);
        } else {
            // Si el código no cumple con el formato esperado, retornar error
            return response()->json([
                'error' => 'Código no válido'
            ], 400);
        }
    }
}
