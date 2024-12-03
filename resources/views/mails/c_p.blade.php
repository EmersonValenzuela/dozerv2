<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Plantilla de Correo Electrónico con Imágenes</title>
    <style>
        /* Estilos generales */
        body {
            font-family: 'Arial Narrow';
            background-color: white;
            margin: 0;
            padding: 0;
        }

        .email-wrapper {
            width: 100%;
            background-color: white;
            padding: 20px 0;
        }

        .email-content {
            width: 600px;
            margin: 0 auto;
            background: white;
            border-radius: 12px;
        }

        .email-header {
            text-align: center;
            padding-bottom: 20px;
        }

        .email-header img {
            max-width: 100%;
            height: auto;
            border-radius: 8px;
        }

        .email-header h1 {
            color: #333333;
            margin: 20px 0 0;
            font-size: 17px;
        }



        .email-body img {
            width: 100%;
            /* Imagen a tamaño completo */
        }

        .button {
            background-color: #262626;
            color: white;
            padding: 10px 20px;
            text-align: center;
            text-decoration: none;
            border-radius: 5px;
            display: inline-block;
            font-size: 16px;
            margin-top: 20px;
            font-weight: 700;
        }

        .email-footer {
            text-align: center;
            font-size: 12px;
            color: #888888;
            padding-top: 20px;
            border-top: 2px solid #f1f1f1;
        }

        .email-footer a {
            color: #333333;
            text-decoration: none;
        }

        .text-cont {
            color: #8e8e8e !important;

            font-weight: 200;
            font-size: 15px;

            text-align: justify;
        }

        .text-titulo {
            font-size: 20px;
            text-align: center;
        }

        .span-wssp {
            color: #cfceb8;
            text-decoration: underline !important;
        }

        .color-white {
            color: white;
        }

        .text-titulo-descarga {
            font-size: 13px !important;
            text-align: left;
        }

        .text-id {
            color: #cfceb8;
        }

        .cont-descarga {
            text-align: justify;
            color: #e5e5e5;
            font-size: 11px;
        }

        .btn-descarga {
            background: rgb(188, 187, 167);
            background: linear-gradient(93deg,
                    rgba(188, 187, 167, 1) 0%,
                    rgba(252, 250, 223, 1) 100%);
            border-radius: 5px;
            text-align: center;
            padding: 5px 2px;
            bottom: 10px;
            position: relative;
        }

        .btn-descarga-style {
            color: #222222 !important;
            font-size: 12px;

            text-decoration: none;
            font-weight: 700;
            justify-content: center;
        }

        .fondo-footer {
            background-color: #f2f2f2;
            display: flex;
            justify-content: center;
        }

        .group-footer {
            padding-top: 1rem !important;
            padding-bottom: 1rem !important;
            align-items: center !important;
            display: flex !important;
        }

        .p-2 {
            padding: 0.5rem !important;
        }

        .text-footer {
            font-size: 15px;
            color: #595959;
            text-align: left;
            font-weight: 700;
            text-align: center;
        }

        .direccion-icon {
            display: flex;
            flex-direction: row;
        }

        .mx-2 {
            margin-right: 0.5rem !important;
            margin-left: 0.5rem !important;
        }

        .fondo-icon:hover {
            background: #c1bfa7;
        }

        .fondo-icon {
            background: rgb(29, 29, 27);
            background: linear-gradient(177deg,
                    rgba(29, 29, 27, 1) 0%,
                    rgba(88, 89, 91, 1) 100%);
            border-radius: 50%;
            padding: 2px;
            margin-right: 0.5rem !important;
            margin-left: 0.5rem !important;
            display: flex !important;
            align-items: center !important;
        }

        .fondo-fb {
            height: 40px !important;
            width: 40px !important;
        }

        .icon-style {
            width: 18px !important;
            margin: auto;
            display: block;
        }

        .icon-stylefb {
            width: 9px !important;
            margin: auto;
            display: block;
        }

        .icon-styletk {
            width: 15px !important;
            margin: auto;
            display: block;
        }

        .linia-footer {
            background-color: #c9c9c9;
            height: 5px;
        }
    </style>
</head>

<body>
    <span style="display:none; visibility:hidden; mso-hide:all;">
        Por medio del presente, nos dirigimos a usted para agradecerle por haber llevado a cabo y concluido seminario
        virtual que le ha sido asignada.
    </span>
    <div class="email-wrapper">
        <div class="email-content">
            <!-- Encabezado del correo con imagen -->
            <div class="email-header">
                <img src="{{ asset('mails/images2/img/dozer_encabezado.png') }}" alt="Encabezado del Correo" />
                <h1 class="text-titulo">
                    Constancia de Participación por Instituto Dozer
                </h1>
            </div>

            <!-- Cuerpo del correo con imagen -->
            <div class="email-body text-cont">
                <div style="margin: 0 20px">
                    <p>Director de Registros Académicos de Instituto Dozer</p>
                    <p>
                        Por medio del presente, nos dirigimos a usted para agradecerle por haber llevado a cabo y
                        concluido seminario virtual que le ha sido asignada.
                    </p>
                    <br>
                    <img style="
                background-position: center center;
                background-size: cover;
                background-repeat: no-repeat;
                height: 334px;
                position: relative;
              "
                        src="{{ asset('mails/images2/img/cp.png') }}" alt="Imagen de servicio" />

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

                    <table align="center" style="margin: 20px auto; text-align: center;">
                        <tr>
                            <td>
                                <a href="{{ $downloadUrl }}"
                                    style="
                          display: inline-block;
                          background-color: #262626;
                          color: white !important;
                          padding: 10px 80px;
                          text-align: center;
                          text-decoration: none;
                          border-radius: 5px;
                          font-size: 16px;
                          font-weight: bold;
                          margin: 34px auto;
                        ">
                                    Descarga Constancia
                                </a>
                            </td>
                        </tr>
                    </table>
                    <div style="border-bottom: 5px solid #efefef"> </div>
                    <p>
                        Si tienes alguna inquietud, ingresa en el Portal de Asesoramiento
                        o ponte en contacto con nosotros a través de
                        <span class="text-id span-wssp">
                            WhatsApp clicando en el botón verde:</span>
                    </p>
                    <a href="https://wa.link/bgwth9" Target="_blank">
                        <img style="
                  background-size: cover;
                  width: 40% !important;
                  background-position: center !important;
                  margin: auto;
                  display: block;
                  padding: 17px 0px;
                "
                            src="{{ asset('mails/images2/img/wssp.png') }}" alt="Imagen de servicio" /></a>
                </div>

                <img src="{{ asset('mails/images2/img/ademico-dozer.png') }}" alt="Imagen de servicio" />
                <div class="fondo-footer">
                    <table align="center" width="100%" cellpadding="0" cellspacing="0"
                        style="background-color: #f2f2f2;">
                        <tr>
                            <td align="center" style="padding: 1rem;">
                                <p
                                    style="padding: 0.5rem; margin: 0; font-family: Arial Narrow, sans-serif; font-size: 14px; color: #000;">
                                    Visita nuestra web y síguenos en redes sociales:
                                </p>
                                <table align="center" cellpadding="0" cellspacing="0">
                                    <tr>
                                        <td style="padding: 0 5px;">
                                            <a href="https://institutodozer.edu.pe/" target="_blank">
                                                <div class="mx-2 fondo-icon fondo-fb"><img
                                                        src="{{ asset('mails/images2/img/icon-web.png') }}"
                                                        alt="" class="icon-style" />
                                                </div>
                                            </a>
                                        </td>
                                        <td style="padding: 0 5px;">
                                            <a href="https://www.facebook.com/InstitutoDozer" target="_blank">
                                                <div class="mx-2 fondo-icon fondo-fb">
                                                    <img src="{{ asset('mails/images2/img/icon-fb.png') }}"
                                                        alt="" class="icon-stylefb" />
                                                </div>
                                            </a>
                                        </td>
                                        <td style="padding: 0 5px;">
                                            <a href="https://www.instagram.com/instituto.dozer/" target="_blank">
                                                <div class="mx-2 fondo-icon fondo-fb"><img
                                                        src="{{ asset('mails/images2/img/icon-ig.png') }}"
                                                        alt="" class="icon-style" />
                                                </div>
                                            </a>
                                        </td>
                                        <td style="padding: 0 5px;">
                                            <a href="https://www.linkedin.com/company/institutodozer/" target="_blank">
                                                <div class="mx-2 fondo-icon fondo-fb"><img
                                                        src="{{ asset('mails/images2/img/icon-in.png') }}"
                                                        alt="" class="icon-style" />
                                                </div>
                                            </a>
                                        </td>
                                        <td style="padding: 0 5px;">
                                            <a href="#" target="_blank">
                                                <div class="mx-2 fondo-icon fondo-fb"><img
                                                        src="{{ asset('mails/images2/img/icon-yt.png') }}"
                                                        alt="" class="icon-style" />
                                                </div>
                                            </a>
                                        </td>
                                        <td style="padding: 0 5px;">
                                            <a href="https://www.tiktok.com/@institutodozer" target="_blank">
                                                <div class="mx-2 fondo-icon fondo-fb"><img
                                                        src="{{ asset('mails/images2/img/icon-tk.png') }}"
                                                        alt="" class="icon-style" />
                                                </div>
                                            </a>
                                        </td>
                                    </tr>
                                </table>
                            </td>
                        </tr>
                    </table>
                </div>
                <div class="linia-footer"></div>
            </div>

            <!-- Pie de página del correo -->

        </div>
    </div>
</body>

</html>
