<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>CONSTANCIA DE MATRICULA</title>
    <link rel="icon" href="{{ asset('mails/img/icon-dozer.svg') }}" type="image/x-icon" />

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous" />
    <style>
        @import url(https://db.onlinewebfonts.com/c/9dd314969e0d38ad57d94762ed1a621c?family=Swiss+721+Bold+Condensed);

        .fondo-encabezado {
            background: rgb(29, 29, 27);
            background: linear-gradient(177deg,
                    rgba(29, 29, 27, 1) 0%,
                    rgba(88, 89, 91, 1) 100%);
            padding: 5px 10px;
        }

        .logoDozer {
            width: 150px;
        }

        .fondo-encabezado-dos {
            background: rgb(188, 187, 167);
            background: linear-gradient(59deg,
                    rgba(188, 187, 167, 1) 0%,
                    rgba(252, 250, 223, 1) 100%);
            height: 15px;
        }

        .p-50px {
            padding: 40px 0;
        }

        .text-titulo {
            font-family: "Swiss 721 Bold Condensed";
            font-size: 20px;
        }

        .text-cont {
            color: #8e8e8e;
            font-family: "Swiss 721 Condensed BT";
            font-weight: 200;
            font-size: 15px;
            margin: 0 0 40px 0px;
            text-align: justify;
        }

        .section-descarga {
            position: absolute;
            top: 93%;
        }

        .section-descargacp {
            position: absolute;
            top: 102%;
        }

        .text-titulo-descarga {
            font-size: 13px !important;
            font-family: "Swiss 721 Bold Condensed";
        }

        .cont-descarga {
            text-align: justify;
            color: #e5e5e5;
            font-size: 11px;
            font-family: "Swiss 721 Condensed BT";
        }

        .m-100px {
            margin: 0 70px 0 0;
        }

        .btn-descarga {
            background: rgb(188, 187, 167);
            background: linear-gradient(93deg,
                    rgba(188, 187, 167, 1) 0%,
                    rgba(252, 250, 223, 1) 100%);
            border-radius: 5px;
            text-align: center;
            padding: 2px;
            bottom: 10px;
            position: relative;
        }

        .btn-descarga-style {
            color: #222222 !important;
            font-size: 12px;
            font-family: "Swiss 721 Bold Condensed";
            text-decoration: none;
            font-weight: 500;
            display: flex;
            justify-content: center;
        }

        .text-id {
            color: #cfceb8;
        }

        .text-encabezado {
            font-family: "Swiss 721 Condensed BT";
            font-size: 12px;
        }

        .vertical {
            background-color: #fcfadf;
            width: 5px;
            height: 50px;
            right: 10px;
            position: relative;
            margin: 20px 0;
            border-radius: 1.5px;
        }

        .separador {
            background-color: #efefef;
            height: 10px;
        }

        .color-asesor {
            color: #666666;
        }

        .span-wssp {
            font-family: "Swiss 721 Bold Condensed";
        }

        .fondo-wssp {
            background: rgb(241, 242, 242);
            background: linear-gradient(62deg,
                    rgba(241, 242, 242, 1) 0%,
                    rgba(255, 255, 255, 1) 100%);
            /*margin: 0 38% 5% 38% !important;*/
            border-radius: 40px 0px;
            -webkit-box-shadow: 18px 16px 67px -12px #fff;
            -moz-box-shadow: 18px 16px 67px -12px rgba(0, 0, 0, 0.75);
            box-shadow: 6px 11px 19px 0px rgba(0, 0, 0, 0.125);
            border: 7px solid white;
        }

        .wssp-50 {
            width: 50px;
        }

        .titulo-wssp {
            font-size: 21px;
            font-family: "Swiss 721 Condensed BT";
            color: #666666;
        }

        .number-wssp {
            font-size: 25px;
            font-family: "Swiss 721 Bold Condensed";
            color: #444444;
        }

        .img-gildo {
            width: 200px;
        }

        .section-final {
            position: absolute;
            top: 1920px;
        }

        .titulo-registro {
            font-size: 14px;
            font-family: "Swiss 721 Bold Condensed";
        }

        .px-80 {
            padding: 0 30px;
        }

        .fondo-footer {
            background-color: #f2f2f2;
        }

        .text-footer {
            font-family: "Swiss 721 Bold Condensed";
            font-size: 15px;
            color: #595959;
        }

        .linia-footer {
            background-color: #c9c9c9;
            height: 5px;
        }

        .horizontal {
            background-color: #cfceb8;
            width: 50px;
            height: 5px;
            right: 10px;
            position: relative;
            margin: 0 20px;
            border-radius: 1.5px;
        }

        .icon-style {
            width: 18px;
            margin: auto;
            display: block;
        }

        .icon-stylefb {
            width: 9px;
            margin: auto;
            display: block;
        }

        .icon-styletk {
            width: 15px;
            margin: auto;
            display: block;
        }

        .fondo-icon {
            background: rgb(29, 29, 27);
            background: linear-gradient(177deg,
                    rgba(29, 29, 27, 1) 0%,
                    rgba(88, 89, 91, 1) 100%);
            border-radius: 50%;
            padding: 10px;
        }

        .fondoyt {
            width: 50px;
            height: 50px;
        }

        .text-contdirec {
            color: #8e8e8e;
            font-family: "Swiss 721 Condensed BT";
            font-weight: 200;
            font-size: 13px;
        }

        .top-bloque {
            bottom: 7rem;
            position: relative;
        }

        .top-bloquecp {
            position: relative;
            top: 1rem;
        }

        .section-descarga-curso {
            position: absolute;
            top: 140%;
        }

        .top-bloque-curso {
            position: relative;
            top: 15rem;
        }

        .text-cont-dos {
            color: #8e8e8e;
            font-family: "Swiss 721 Condensed BT";
            font-weight: 200;
            font-size: 15px;
            margin: 20px 0px !important;
        }

        .section-finalcp {
            position: absolute;
            top: 2010px;
        }

        .fondo-encabezado-cip {
            padding: 5px 10px;
        }

        .encabezado-cip {
            width: 100%;
        }

        .text-cip {
            position: absolute;
            top: 2rem;
        }

        .img-cip {
            width: 150px;
        }

        .text-cip-titulo {
            font-family: "Swiss 721 Bold Condensed";
            font-size: 31px;
        }

        .text-encabezado-cip {
            position: absolute;
            top: 12px;
            right: 100px;
        }

        .btn-descargarcip {
            background: #a41e26;
            color: white;
            text-align: center;
            text-decoration: none;
            padding: 5px 130px;
            border-radius: 10px;
            font-size: 27px;
            font-family: "Swiss 721 Bold Condensed";
            margin-bottom: 60px;
        }

        .top-12px {
            top: 15rem;
            position: relative;
        }

        .section-final-cip {
            position: absolute;
            top: 90.5rem;
        }

        .btn-descargarcap {
            background: #bfbc99;
            color: white;
            text-align: center;
            text-decoration: none;
            padding: 5px 130px;
            border-radius: 10px;
            font-size: 27px;
            font-family: "Swiss 721 Bold Condensed";
            margin-bottom: 60px;
        }

        .fondo-icon:hover {
            background: #c1bfa7;
        }

        .section-final-m {
            position: absolute;
            top: 1242px;
        }

        .section-descarga-diplomado {
            position: absolute;
            top: 135%;
        }

        .top-bloque-diplomado {
            position: relative;
            top: 13rem;
        }

        .seccion-especip {
            top: 19rem;
            position: relative;
        }

        .seccion-dicip {
            top: 13rem;
            position: relative;
        }

        .seccion-especap {
            top: 20rem;
            position: relative;
        }

        .img-fondofinal {
            height: 225px;
            width: 100%;
        }

        .margin-sectionfinal {
            padding: 55px 0 0 0;
        }

        .fondo-fb {
            height: 40px;
            width: 40px;
        }

        .text-general {
            position: absolute;
            top: 553px;
            width: 300px;
            margin: 10px 40px;
            text-align: center;
        }

        @media (min-width: 576px) {
            .text-encabezado {
                font-size: 15px;
            }

            .vertical {
                height: 80px;
            }

            .text-general {
                top: 594px;
                width: 180px;
                margin: 5px;
            }

            .section-final-m {
                top: 1267px;
            }

            .cont-descarga {
                font-size: 9px;
                padding: 0;
            }

            .text-footer {
                font-size: 15px;
            }

            .text-footer {
                text-align: left;
            }

            .btn-descarga {
                bottom: 18px;
            }
        }

        @media (min-width: 768px) {
            .text-general {
                width: 210px;
                margin: 19px;
                top: 660px;
            }

            .text-titulo-descarga {
                font-size: 15px !important;
                text-align: left;
            }

            .cont-descarga {
                font-size: 13px;
            }

            .btn-descarga {
                padding: 4px;
                bottom: 5px;
            }

            .section-final-m {
                top: 1307px;
            }

            .text-titulo {
                font-size: 28px;
            }

            .text-cont {
                font-size: 20px;
            }

            .text-cont-dos {
                font-size: 20px;
            }

            .img-gildo {
                width: 250px;
            }
        }

        @media (min-width: 992px) {
            .text-general {
                width: 310px;
                margin: 30px;
                top: 580px;
            }

            .text-titulo-descarga {
                font-size: 23px !important;
            }

            .cont-descarga {
                font-size: 18px;
            }

            .btn-descarga-style {
                font-size: 18px;
            }

            .img-fondofinal {
                height: 350px;
            }

            .img-gildo {
                width: 370px;
            }

            .section-final-m {
                top: 1510px;
            }

            .titulo-registro {
                font-size: 24px;
                font-family: "Swiss 721 Bold Condensed";
            }

            .text-contdirec {
                font-size: 18px;
            }
        }

        @media (min-width: 1200px) {
            .text-general {
                top: 674px;
                width: 370px;
            }

            .fondo-encabezado-cip {
                padding: 5px 50px;
            }

            .text-encabezado {
                font-size: 23px;
            }

            .logoDozer {
                width: 220px;
            }

            .text-titulo {
                font-size: 31px;
            }

            .text-cont {
                font-size: 25px;
            }

            .section-descarga {
                top: 126%;
            }

            .m-100px {
                margin: 0 100px;
            }

            .text-titulo-descarga {
                font-size: 28px !important;
            }

            .cont-descarga {
                font-size: 24px;
            }

            .btn-descarga-style {
                font-size: 22px;
            }

            .text-cont-dos {
                font-size: 25px;
            }

            .section-final-m {
                position: absolute;
                top: 1768px;
                width: 1100px !important;
            }

            .img-gildo {
                width: 420px;
            }

            .titulo-registro {
                font-size: 34px;
            }

            .text-contdirec {
                color: #8e8e8e;
                font-family: "Swiss 721 Condensed BT";
                font-weight: 200;
                font-size: 25px;
            }

            .px-80 {
                padding: 0 0 0 40px;
            }

            .img-fondofinal {
                height: 100%;
                width: 100%;
            }

            .separador {
                margin: 20px;
            }

            .text-footer {
                font-size: 25px;
            }

            .icon-stylefb {
                width: 15px;
                margin: auto;
                display: block;
            }

            .icon-style {
                width: 19px;
                margin: auto;
                display: block;
            }
        }

        @media (min-width: 1400px) {
            .text-general {
                top: 667px;
                width: 393px;
            }

            .section-final-m {
                position: absolute;
                top: 1866px;
            }

            .icon-style {
                width: 19px;
                margin: auto;
                display: block;
            }

            .text-contdirec {
                width: 785px;
            }

            .cont-descarga {
                padding: 0 0 35px 0;
            }
        }
    </style>
    <link href="https://db.onlinewebfonts.com/c/80f213b8a30f391ec4d45836fae58663?family=Swiss+721+Condensed+BT"
        rel="stylesheet" type="text/css" />
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://db.onlinewebfonts.com/c/9dd314969e0d38ad57d94762ed1a621c?family=Swiss+721+Bold+Condensed"
        rel="stylesheet" />
</head>

<body>
    <section class="container container-sm container-md container-xxl">
        <div class="fondo-encabezado">
            <div class="container">
                <div class="row">
                    <div class="d-flex flex-row my-3 justify-content-between align-items-center">
                        <div class="p-2">
                            <img class="logoDozer" src="{{ asset('mails/img/logo-dozer.png') }}" alt="" />
                        </div>
                        <div class="d-flex justify-content-end">
                            <div class="vertical"></div>
                            <div class="p-2 text-white text-encabezado d-flex align-items-center">
                                Construyendo un legado de excelencia <br />
                                académica a estudiantes y profesionales <br />
                                del sector construcción
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="fondo-encabezado-dos"></div>
    </section>

    <section class="container container-lg px-5">
        <div class="row">
            <div class="p-50px">
                <h1 class="text-center text-titulo">
                    Constancia de Matricula por Instituto Dozer
                </h1>
            </div>
            <div class="text-cont">
                <p>Director de Registros Académicos de Instituto Dozer</p>
                <p>
                    Sean mis primeras palabras para darles la más cordial bienvenida a
                    la apasionante aventura de iniciar su futura formación, en Instituto
                    Dozer. Aquí, estamos dispuestos a ayudarlos con el objetivo de que,
                    durante los años que permanezcas con nosotros, nuestras
                    capacitaciones desarrolle su crecimiento profesional y personal.
                </p>
                <p>
                    Siempre hemos reconocido que nuestros estudiantes soportan niveles
                    alta exigencia, motivados por formarse en una institución con el
                    perfil de excelencia y credibilidad académica.
                </p>
            </div>
            <div>
                <div>
                    <img class="w-100 d-sm-none d-md-none d-lg-none d-xl-none d-xxl-none"
                        src="{{ asset('mails/img/cm-movil.png') }}" alt="" />
                </div>
                <div>
                    <img class="w-100 d-none d-sm-block d-md-block d-lg-block d-xl-block d-xxl-block"
                        src="{{ asset('mails/img/img-cm.png') }}" alt="" />
                </div>

                <div class="d-flex flex-column text-general d-sm-none d-md-none d-lg-none d-xl-none d-xxl-none">
                    <div class="p-2">
                        <div class="text-white">
                            <h3 class="text-titulo-descarga">
                                Constancia de Matricula por <br />
                                <span class="text-id">Instituto Dozer </span>
                            </h3>
                        </div>
                    </div>
                    <div class="">
                        <div class="cont-descarga text-center">
                            <p>
                                Te animo a continuar persiguiendo tus sueños y aspiraciones
                                con la misma determinación y pasión que hasta ahora. Estoy
                                convencido de que tu futuro será aún más brillante y lleno de
                                logros. Enhorabuena por este merecido éxito. Estoy emocionado
                                por las increíbles cosas que vendrán en tu camino. Celebra
                                este logro y recuerda siempre lo lejos que has llegado.
                            </p>
                        </div>
                    </div>
                    <div class="p-2">
                        <div class="btn-descarga">
                            <a class="btn-descarga-style" href="">Descargar el documento</a>
                        </div>
                    </div>
                </div>

                <div
                    class="d-flex flex-column text-general d-none d-sm-block d-md-block d-lg-block d-xl-block d-xxl-block">
                    <div class="p-2">
                        <div class="text-white">
                            <h3 class="text-titulo-descarga">
                                Constancia de Matricula por <br />
                                <span class="text-id">Instituto Dozer </span>
                            </h3>
                        </div>
                    </div>
                    <div class="p-2">
                        <div class="cont-descarga">
                            <p>
                                Te animo a continuar persiguiendo tus sueños y aspiraciones
                                con la misma determinación y pasión que hasta ahora. Estoy
                                convencido de que tu futuro será aún más brillante y lleno de
                                logros. Enhorabuena por este merecido éxito. Estoy emocionado
                                por las increíbles cosas que vendrán en tu camino. Celebra
                                este logro y recuerda siempre lo lejos que has llegado.
                            </p>
                        </div>
                    </div>
                    <div class="p-2">
                        <div class="btn-descarga">
                            <a class="btn-descarga-style" href="">Descargar el documento</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="text-cont-dos">
                <p>
                    En caso de no haber solicitado la constancia de matricula, puedes
                    ingnorar este correo.
                </p>
            </div>
            <div class="separador"></div>

            <div class="text-cont-dos py-3">
                <p class="color-asesor">
                    Si tienes alguna inquietud, ingresa en el Portal de Asesoramiento o
                    ponte en contacto con nosotros a través de
                    <span class="text-id text-decoration-underline span-wssp">
                        WhatsApp clicando en el botón verde:</span>
                </p>
            </div>
            <div class="d-flex flex-row justify-content-center">
                <div class="d-flex flex-row justify-content-center fondo-wssp align-items-center">
                    <div class="p-2">
                        <a href="">
                            <img class="wssp-50" src="{{ asset('mails/img/wssp.png') }}" alt="" />
                        </a>
                    </div>

                    <div class="p-2 d-flex flex-column">
                        <div class="titulo-wssp">Soporte Instituto Dozer</div>
                        <div class="number-wssp">+51 936 126 985</div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="container container-sm container-md container-xxl">
        <div class="margin-sectionfinal">
            <img class="w-100 img-fondofinal" src="{{ asset('mails/img/fondo.png') }}" alt="" />
        </div>
        <div class="section-final-m">
            <div class="d-flex flex-row mb-3 d-flex align-items-center">
                <div class="">
                    <img class="img-gildo d-none d-sm-block d-md-block d-lg-block d-xl-block d-xxl-block"
                        src="{{ asset('mails/img/imagen-dos.png') }}" alt="" />
                </div>
                <div class="d-flex flex-column px-80">
                    <div class="p-2 titulo-registro">Gildo Darwin Espinoza Reyes</div>
                    <div class="horizontal"></div>
                    <div class="p-2 text-contdirec">
                        Director de Registros Académicos, CPC N° 6498
                    </div>
                    <div class="p-2 text-contdirec">
                        Nos esforzamos diariamente para cumplir con nuestra misión:
                        inspirar y educar a estudiantes y profesionales del sector
                        construcción, líderes del futuro a través de programas
                        innovadores, para crear un impacto positivo en la sociedad.
                    </div>
                </div>
            </div>
        </div>

        <div class="fondo-footer container d-flex justify-content-center">
            <div class="row d-flex align-items-center py-3">
                <div class="d-flex flex-column flex-md-row flex-lg-row flex-xl-row flex-xxl-row">
                    <div class="p-2 text-footer text-align">
                        Visita nuestra web y síguenos en redes sociales:
                    </div>

                    <div class="d-flex flex-row">
                        <a href="https://institutodozer.edu.pe/" target="_blank">
                            <div class="mx-2 fondo-icon fondo-fb">
                                <img class="icon-style" src="{{ asset('mails/img/icon-web.png') }}" alt="" />
                            </div>
                        </a>
                        <a href="https://www.facebook.com/InstitutoDozer" target="_blank">
                            <div class="mx-2 fondo-icon w-50px fondo-fb">
                                <img class="icon-stylefb" src="{{ asset('mails/img/icon-fb.png') }}"
                                    alt="" />
                            </div>
                        </a>
                        <a href="https://www.instagram.com/instituto.dozer/" target="_blank">
                            <div class="mx-2 fondo-icon fondo-fb">
                                <img class="icon-style" src="{{ asset('mails/img/icon-ig.png') }}" alt="" />
                            </div>
                        </a>
                        <a href="https://www.linkedin.com/company/institutodozer/" target="_blank">
                            <div class="mx-2 fondo-icon fondo-fb">
                                <img class="icon-style" src="{{ asset('mails/img/icon-in.png') }}" alt="" />
                            </div>
                        </a><a href="" target="_blank">
                            <div class="mx-2 fondo-icon d-flex align-items-center fondo-fb">
                                <img class="icon-style" src="{{ asset('mails/img/icon-yt.png') }}" alt="" />
                            </div>
                        </a>

                        <a href="https://www.tiktok.com/@institutodozer" target="_blank">
                            <div class="mx-2 fondo-icon w-50px fondo-fb">
                                <img class="icon-styletk" src="{{ asset('mails/img/icon-tk.png') }}"
                                    alt="" />
                            </div>
                        </a>
                    </div>
                </div>
            </div>
        </div>
        <div class="linia-footer"></div>
    </section>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>
</body>

</html>
