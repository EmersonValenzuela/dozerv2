<!DOCTYPE html>


<html lang="en" class="light-style layout-wide  customizer-hide" dir="ltr" data-theme="theme-default"
    data-assets-path="{{ asset('') }}" data-template="vertical-menu-template">

<head>
    <meta charset="utf-8">
    <meta name="viewport"
        content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0">

    <title>Generador de Certificados | Instituto Dozer</title>

    <meta name="csrf-token" content="{{ csrf_token() }}">

    <meta name="description"
        content="Materialize – is the most developer friendly &amp; highly customizable Admin Dashboard Template.">
    <meta name="keywords"
        content="dashboard, material, material design, bootstrap 5 dashboard, bootstrap 5 design, bootstrap 5">

    <style>
        @import url("https://fonts.googleapis.com/css2?family=Rubik:ital,wght@0,300..900;1,300..900&display=swap");
    </style>

    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="{{ asset('img/favicon/favicondozer.ico') }}" />

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Rubik:ital,wght@0,300..900;1,300..900&display=swap"
        rel="stylesheet" />

    <!-- Icons -->
    <link rel="stylesheet" href="{{ asset('vendor/fonts/materialdesignicons.css') }}">
    <link rel="stylesheet" href="{{ asset('vendor/fonts/flag-icons.css') }}">

    <!-- Menu waves for no-customizer fix -->
    <link rel="stylesheet" href="{{ asset('vendor/libs/node-waves/node-waves.css') }}">

    <!-- Core CSS -->
    <link rel="stylesheet" href="{{ asset('vendor/css/rtl/core.css') }}" class="template-customizer-core-css">
    <link rel="stylesheet" href="{{ asset('vendor/css/rtl/theme-default.css') }}" class="template-customizer-theme-css">
    <link rel="stylesheet" href="{{ asset('css/demo.css') }}">

    <!-- Vendors CSS -->
    <link rel="stylesheet" href="{{ asset('vendor/libs/perfect-scrollbar/perfect-scrollbar.css') }}">
    <link rel="stylesheet" href="{{ asset('vendor/libs/typeahead-js/typeahead.css') }}">
    <!-- Vendor -->

    <link rel="stylesheet" href="{{ asset('vendor/libs/%40form-validation/umd/styles/index.min.css') }}">
    <link rel="stylesheet" href="{{ asset('vendor/libs/sweetalert2/sweetalert2.css') }}">

    <!-- Page CSS -->
    <!-- Page -->
    <link rel="stylesheet" href="{{ asset('vendor/css/pages/page-auth.css') }}">

    <!-- Helpers -->
    <script src="{{ asset('vendor/js/helpers.js') }}"></script>
    <!--! Template customizer & Theme config files MUST be included after core stylesheets and helpers.js in the <head> section -->
    <!--? Template customizer: To hide customizer set displayCustomizer value false in config.js.  -->
    <script src="{{ asset('vendor/js/template-customizer.js') }}"></script>
    <!--? Config:  Mandatory theme config file contain global vars & default theme options, Set your preferred theme option in this file.  -->
    <script src="{{ asset('js/config.js') }}"></script>

</head>

<body>

    <!-- Content -->

    <div class="position-relative">
        <div class="authentication-wrapper authentication-basic container-p-y">
            <div class="authentication-inner py-4">

                <div class=" p-2">
                    <!-- Logo -->
                    <div class="app-brand justify-content-center mt-5">
                        <img class="img-logo-login" src="{{ asset('img/dozer.png') }}" alt="">
                    </div>
                    <!-- /Logo -->
                    <!-- Reset Password -->
                    <div class="card-body  text-white">
                        <h4 class="mb-2 fw-bold text-white text-center">Actualiza
                            tu contraseña</h4>
                        <p class="mb-4 text-center">Digita tu nueva contraseña, te recomendamos
                            que uses almenos un número </p>
                        <form id="formAuthentication" class="mb-3">
                            <input type="token" name="token" value="{{ $token }}" hidden>
                            <div class="mb-3 form-password-toggle">
                                <div class="text-white fw-bold">Nueva contraseña:</div>
                                <div class="input-group input-group-merge">
                                    <div class="form-floating form-floating-outline">
                                        <input type="password" id="password" class="form-control" name="password"
                                            placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;"
                                            aria-describedby="password">
                                    </div>
                                    <span class="input-group-text cursor-pointer"><i
                                            class="mdi mdi-eye-off-outline"></i></span>
                                </div>
                            </div>

                            <div class="mb-3 form-password-toggle">
                                <div class="text-white fw-bold">Confirma Nueva contraseña:</div>
                                <div class="input-group input-group-merge">
                                    <div class="form-floating form-floating-outline">
                                        <input type="password" id="confirm-password" class="form-control"
                                            name="confirm-password"
                                            placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;"
                                            aria-describedby="confirm-password">
                                    </div>
                                    <span class="input-group-text cursor-pointer"><i
                                            class="mdi mdi-eye-off-outline"></i></span>
                                </div>
                            </div>

                            <button class="btn btn-iniciosesion d-grid w-100 mb-3" type="submit">Establecer nueva
                                contraseña</button>
                        </form>

                    </div>
                </div>
                <!-- /Reset Password -->
            </div>
        </div>
    </div>
    <!-- / Content -->

    <!-- Core JS -->
    <!-- build:js vendor/js/core.js -->
    <script src="{{ asset('vendor/libs/jquery/jquery.js') }}"></script>
    <script src="{{ asset('vendor/libs/popper/popper.js') }}"></script>
    <script src="{{ asset('vendor/js/bootstrap.js') }}"></script>
    <script src="{{ asset('vendor/libs/node-waves/node-waves.js') }}"></script>
    <script src="{{ asset('vendor/libs/perfect-scrollbar/perfect-scrollbar.js') }}"></script>
    <script src="{{ asset('vendor/libs/hammer/hammer.js') }}"></script>
    <script src="{{ asset('vendor/libs/i18n/i18n.js') }}"></script>
    <script src="{{ asset('vendor/libs/typeahead-js/typeahead.js') }}"></script>
    <script src="{{ asset('vendor/js/menu.js') }}"></script>
    <script src="{{ asset('vendor/libs/sweetalert2/sweetalert2.js') }}"></script>
    <!-- endbuild -->

    <!-- Vendors JS -->
    <script src="{{ asset('vendor/libs/%40form-validation/umd/bundle/popular.min.js') }}"></script>
    <script src="{{ asset('vendor/libs/%40form-validation/umd/plugin-bootstrap5/index.min.js') }}"></script>
    <script src="{{ asset('vendor/libs/%40form-validation/umd/plugin-auto-focus/index.min.js') }}"></script>

    <!-- Main JS -->
    <script src="{{ asset('js/main.js') }}"></script>


    <!-- Page JS -->
    <script src="{{ asset('js/reset-password.js') }}"></script>

</body>

</html>

<!-- beautify ignore:end -->
