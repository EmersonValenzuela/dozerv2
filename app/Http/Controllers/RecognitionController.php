<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

require(public_path('fpdf/fpdf.php'));

class RecognitionController extends Controller
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
        return view('recognition.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $img1 = "img/examples/recognition2.png";

        $name = "Antonella Perez Rodriguez";
        $code = "0745147";
        $course = "Nombre del Curso modular";
        $date = "24 de abril del 2024";

        $text = 'Logrando un promedio final de 19/20, el esfuerzo dedicación y compromiso alcanzado,';
        $text2 = 'deseándole muchos éxitos en su carrera profesional, concedido el día 24 de abril del 2024';

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

        $pdf->SetFont('Oswald-Regular', '', 11);
        $pdf->SetTextColor(117, 117, 117);
        $pdf->SetXY(29.6, 33);
        $pdf->Cell(1, 35, $code, 0, 1, 'L');

        // Configurar para centrar el texto
        $pdf->SetFont('Oswald-Bold', '', 21);
        $pdf->SetTextColor(0, 0, 0);

        $anchoTexto = $pdf->GetStringWidth($name);
        $x = ($anchoPagina - $anchoTexto) / 2;
        $pdf->SetXY($x, 47);
        $pdf->Cell($anchoTexto, 40, $name, '', 1, 'C', false);

        $pdf->SetFont('Oswald-Medium', '', 18);
        $pdf->SetTextColor(0, 0, 0);

        $anchoTexto = $pdf->GetStringWidth($course);
        $x = ($anchoPagina - $anchoTexto) / 2;
        $pdf->SetXY($x, 74);
        $pdf->Cell($anchoTexto, 40, utf8_decode($course), '', 1, 'C', false);

        $pdf->SetFont('Oswald-Light', '', 14);
        $pdf->SetTextColor(127, 128, 128); // color #7f8080
        $anchoTexto = $pdf->GetStringWidth($text);
        $x = ($anchoPagina - $anchoTexto) / 2;
        $pdf->SetXY($x, 89); 
        $pdf->Cell($anchoTexto, 40, utf8_decode($text), 0, 1, 'C');

        $pdf->SetFont('Oswald-Light', '', 14);
        $pdf->SetTextColor(127, 128, 128); // color #7f8080
        $anchoTexto = $pdf->GetStringWidth($text2);
        $x = ($anchoPagina - $anchoTexto) / 2;
        $pdf->SetXY($x, 95); 
        $pdf->Cell($anchoTexto, 40, utf8_decode($text2), 0, 1, 'C');


        $pdf->SetFont('Oswald-Regular', '', 12);
        $pdf->SetTextColor(127, 128, 128); // color #7f8080
        $pdf->SetXY(211, 178.3);
        $pdf->Cell(1, 5, $code, 0, 1, 'L');

        // Guardar el archivo PDF en una carpeta específica dentro del proyecto
        $pdf->Output();
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
