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

        .img-cip {
            width: 80px;
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
            background-color: #BFBC99;
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
        Ha sido un placer acompañarte en este proceso de aprendizaje, y estamos seguros de que seguirás alcanzando
        grandes logros.
    </span>
    <div class="email-wrapper">
        <div class="email-content">
            <!-- Encabezado del correo con imagen -->
            <div class="email-header">
                <img src="img/encabezado-cap.png" alt="Encabezado del Correo" />

                <div style="margin: 0 20px; display: flex
          ;">

                    <div>
                        <h1 class="text-titulo" style="
                  text-align: left !important; ">Certificado de
                            Aprobración de Diplomado <br>
                            por el Colegio de Arquitectos del Perú</h1>
                    </div>
                    <div style="display: flex;     margin-left: auto;"> <img class="img-cip" src="img/cap.png" alt />
                    </div>

                </div>
            </div>

            <!-- Cuerpo del correo con imagen -->
            <div class="email-body text-cont">
                <div style="margin: 0 20px">
                    <p>Director de Registros Académicos de Instituto Dozer</p>
                    <p>
                        En esta ocasión, me dirijo a ti para felicitarte por el impresionante logro que has obtenido. Tu
                        dedicación y esfuerzo constante han dado frutos y te has destacado entre los demás.

                    </p>
                    <p>
                        Tu talento y habilidades son innegables. Has trabajado arduamente para alcanzar tus metas y
                        ahora eres reconocido/a por ello. Tu determinación y perseverancia son dignas de admiración y
                        estoy seguro de que este logro es solo el comienzo de una larga lista de éxitos.

                    </p>
                    <p>
                        Tu talento y trabajo duro son dignos de admiración. Has demostrado
                        ser una persona comprometida y capaz de enfrentar cualquier reto
                        que se te presente. Este logro es un reflejo de tu dedicación y
                        perseverancia en todo lo que haces.
                    </p>
                    <p>
                        Te animo a continuar persiguiendo tus sueños y aspiraciones con la misma determinación y pasión
                        que hasta ahora. Estoy convencido de que tu futuro será aún más brillante y lleno de logros.
                    </p>
                    <p>
                        Enhorabuena por este merecido éxito. Estoy emocionado/a por las increíbles cosas que vendrán en
                        tu camino. Celebra este logro y recuerda siempre lo lejos que has llegado.

                    </p>
                    <br>
                    <img style="
                background-position: center center;
                background-size: cover;
                background-repeat: no-repeat;
                height: 334px;
                position: relative;
              "
                        src="img/cap-diplo.png" alt="Imagen de servicio" />
                    <a style="
                display: flex;
                justify-content: center;
                margin: 34px 150px;
                padding: 9px;
              "
                        href="#" class="button">Descarga Certificado
                    </a>

                    <div style="border-bottom: 5px solid #efefef"></div>

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
                            src="img/wssp.png" alt="Imagen de servicio" /></a>
                </div>

                <img src="img/ideledirec-cap.png" alt="Imagen de servicio" />
                <div class="fondo-footer">
                    <div class="group-footer">
                        <div class>
                            <div class="p-2 text-footer">
                                Visita nuestra web y síguenos en redes sociales:
                            </div>

                            <div class="direccion-icon">
                                <a href="https://institutodozer.edu.pe/" target="_blank">
                                    <div class="mx-2 fondo-icon fondo-fb">
                                        <img class="icon-style" src="img/icon-web.png" alt />
                                    </div>
                                </a>
                                <a href="https://www.facebook.com/InstitutoDozer" target="_blank">
                                    <div class="mx-2 fondo-icon w-50px fondo-fb">
                                        <img class="icon-stylefb" src="img/icon-fb.png" alt />
                                    </div>
                                </a>
                                <a href="https://www.instagram.com/instituto.dozer/" target="_blank">
                                    <div class="mx-2 fondo-icon fondo-fb">
                                        <img class="icon-style" src="img/icon-ig.png" alt />
                                    </div>
                                </a>
                                <a href="https://www.linkedin.com/company/institutodozer/" target="_blank">
                                    <div class="mx-2 fondo-icon fondo-fb">
                                        <img class="icon-style" src="img/icon-in.png" alt />
                                    </div>
                                </a><a href target="_blank">
                                    <div class="fondo-icon fondo-fb">
                                        <img class="icon-style" src="img/icon-yt.png" alt />
                                    </div>
                                </a>

                                <a href="https://www.tiktok.com/@institutodozer" target="_blank">
                                    <div class="mx-2 fondo-icon w-50px fondo-fb">
                                        <img class="icon-styletk" src="img/icon-tk.png" alt />
                                    </div>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="linia-footer"></div>
            </div>

            <!-- Pie de página del correo -->
        </div>
    </div>
</body>

</html>
