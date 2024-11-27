<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>CONSTANCIA DE MATRICULA</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous" />
    <style>
        @import url("https://fonts.googleapis.com/css2?family=Rubik:ital,wght@0,300..900;1,300..900&display=swap");
    </style>

    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Rubik:ital,wght@0,300..900;1,300..900&display=swap"
        rel="stylesheet" />
    <style>
        .fondo-dozer {
            width: 1517px;
        }

        .logo-dozer {
            width: 190px !important;
        }

        .contenido {
            padding: 320px 0px;
        }

        .titulo {
            padding: 25px 450px;
            font-family: rubik;

        }

        .tituto-constancia {
            padding: 25px 410px;
            font-family: rubik;

        }

        .contenido-texto {
            padding: 30px 300px;
            font-size: 25px;
            font-family: rubik;
            color: #4F4F4F !important;
            font-weight: 300;
        }

        .btn-descarga {
            margin: 40px 0;
            background: #C2AC7C !important;
            padding: 7px 150px !important;
            border-radius: 9px;
            color: white !important;
            font-weight: 700 !important;
            font-size: 27px !important;
            font-family: rubik !important;
        }

        .p-logo {
            padding: 35px 0;
        }

        .titulo-espe {
            padding: 25px 480px;
            font-family: rubik;

        }

        .titulo-diplo {
            padding: 25px 520px;
            font-family: rubik;

        }

        .font-titulo {
            font-size: 31px !important;
            color: #171717
        }

        .titulo-excelencia {
            padding: 25px 500px;
            font-family: rubik;

        }


        .btn-descarga-cip {
            margin: 40px 0;
            background: #A41E26 !important;
            padding: 7px 150px !important;
            border-radius: 9px;
            color: white !important;
            font-weight: 700 !important;
            font-size: 27px !important;
            font-family: rubik !important;
        }

        .titulo-cip {
            padding: 25px 410px;
            font-family: rubik;
        }

        .contenido-cip {
            padding: 500px 0px;
        }

        .titulo-cip-diplo {
            padding: 25px 520px;
            font-family: rubik;
        }

        .titulo-curso {
            padding: 25px 550px;
            font-family: rubik;
        }
    </style>
</head>

<body>
    <section class="container-fluid d-flex justify-content-center">

        <div class="text-black position-absolute pt-50 d-flex flex-column mb-3 contenido justify-content-center">
            <div class="p-logo">
                <img class="logo-dozer d-block m-auto" src="{{ asset('mails/img/dozer.png') }}" alt="" />
            </div>
            <div class="text-center titulo">
                <h1 class="fw-bold font-titulo">CONSTANCIA DE MATRÍCULA DE INSTITUTO DOZER</h1>
            </div>

            <div class="contenido-texto text-center">
                <div class="mb-3">
                    Sean mis primeras palabras para darles la más cordial bienvenida a
                    la apasionante aventura de iniciar su futura formación, en Instituto
                    Dozer. Aquí, estamos dispuestos a ayudarlos con el objetivo de que,
                    durante los años que permanezcas con nosotros, nuestras
                    capacitaciones desarrolle su crecimiento profesional y personal.
                </div>

                <div class="mb-3">
                    Siempre hemos reconocido que nuestros estudiantes soportan niveles
                    alta exigencia, motivados por formarse en una institución con el
                    perfil de excelencia y credibilidad académica.
                </div>

                <div class="mb-3">
                    A partir de este momento son comunidad Dozer, les invito a que lo
                    asuman con orgullo. Su nueva tarea en la vida institucional
                    consistirá en reflexionar sus contextos, tener disciplina y
                    dedicación constante, pero sobre todo, comprométanse a trabajar
                    arduamente por impulsar las transformaciones que la educación
                    necesita.
                </div>

                <div class="my-5">
                    <div>
                        Cpc. Gildo Espinoza Reyes <br />
                        (CPC - Callao, N° 6498)
                    </div>
                    <div class="fw-semibold">
                        Director de Registros Académicos <br />
                        de Instituto Dozer
                    </div>
                </div>
                @php
                    use Illuminate\Support\Facades\Crypt;

                    $data = [
                        'route' => $route,
                        'name' => $name,
                        'code' => $studentRecord['code'],
                    ];

                    // Encripta los datos
                    $encryptedData = Crypt::encryptString(json_encode($data));

                    // Genera la URL para la descarga
                    $downloadUrl = route('home.certificate', ['data' => $encryptedData]);
                @endphp

                <div>
                    <a href="{{ $downloadUrl }}" class="btn btn-descarga">Descargar</a>
                </div>
            </div>
        </div>
    </section>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>
</body>

</html>
