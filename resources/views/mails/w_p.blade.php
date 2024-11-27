<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>CONSTANCIA DE PARTICIPACIÓN A WEBINAR</title>

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
        <div class="d-flex justify-content-start">
            <div>
                <img class="fondo-dozer" src="{{ asset('mails/img/fondo-participacion.png')}}" alt="..." />
            </div>
        </div>

        <div class="text-black position-absolute pt-50 d-flex flex-column mb-3 contenido justify-content-center">
            <div class="p-logo">
                <img class="logo-dozer d-block m-auto" src="{{ asset('mails/img/dozer.png')}}" alt="" />
            </div>
            <div class="text-center tituto-constancia">
                <h1 class="fw-bold font-titulo">
                    CONSTANCIA DE PARTICIPACIÓN DE INSTITUTO DOZER
                </h1>
            </div>

            <div class="contenido-texto text-center">
                <div class="mb-3">
                    Por medio del presente, nos dirigimos a usted para agradecerle por
                    haber llevado a cabo y concluido seminario virtual que le ha sido
                    asignada.
                </div>

                <div class="mb-3">
                    De parte del equipo de Instituto Dozer, le expresamos que gracias a
                    su trabajo hemos dado un paso adelante. Por ello, le reiteramos
                    nuestra confianza y le deseamos más y mayores éxitos en el futuro.
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
                <div>
                    <button class="btn btn-descarga" type="submit">Descargar</button>
                </div>
            </div>
        </div>
    </section>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>
</body>

</html>
