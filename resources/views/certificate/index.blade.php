@extends('Layout/App')

@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">

        <p class="text-white px-5 fw-bold font-cat pt-3">Generar Constancia de Matricula </p>


        <div class="d-flex flex-row mb-3" id="dataConstancy">
            <div class="p-2">
                <div class="d-flex flex-column flex-sm-row justify-content-center text-center gap-5 fondo-cargacerti">
                    <div class="d-flex flex-column align-items-center">
                        <img src="https://certificados.institutodozer.edu.pe/img/avatars/1.png" alt="user-avatar"
                            class="d-block w-px-250 h-px-200 rounded mb-3" id="uploadedAvatar">
                        <div class="button-wrapper">
                            <label for="upload"
                                class="btn btn-primary me-2 mb-3 waves-effect waves-light btn-generador-img" tabindex="0">
                                <span class="d-none d-sm-block">Subir Hoja 1</span>
                                <i class="mdi mdi-tray-arrow-up d-block d-sm-none"></i>
                                <input type="file" id="upload" class="account-file-input" hidden=""
                                    accept="image/png, image/jpeg">
                            </label>
                            <div class="small text-white">Allowed JPG, GIF or PNG. Max size of 800K</div>
                        </div>
                    </div>
                    <div class="d-flex flex-column align-items-center">
                        <img src="https://certificados.institutodozer.edu.pe/img/avatars/1.png" alt="user-avatar"
                            class="d-block w-px-250 h-px-200 rounded mb-3" id="uploadedAvatar2">
                        <div class="button-wrapper">
                            <label for="upload2"
                                class="btn btn-primary me-2 mb-3 waves-effect waves-light btn-generador-img" tabindex="0">
                                <span class="d-none d-sm-block">Subir Hoja 2</span>
                                <i class="mdi mdi-tray-arrow-up d-block d-sm-none"></i>
                                <input type="file" id="upload2" class="account-file-input2" hidden=""
                                    accept="image/png, image/jpeg">
                            </label>
                            <div class="small text-white">Allowed JPG, GIF or PNG. Max size of 800K</div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="p-2 flex-column d-flex justify-content-center">

                <div class="p-2 ">
                    <div class="mb-3 px-2">
                        <label for="typeCertificate" class="form-label text-white">Tipo de Certificado</label>
                        <select id="course" class=" form-select">
                        </select>
                    </div>

                </div>
            </div>

        </div>

        <!--Contenido-->
        <div class="d-flex mb-3">
            <div class="me-auto p-2">
                <div class="d-flex flex-row px-5 pb-3">
                    <div class="input-wrapper  me-3">
                        <input type="search" id="referralLink" name="referralLink" class=" bg-input "
                            placeholder=" Buscar por Nombre o Código">
                        <span class="mdi mdi-magnify input-icon"></span>
                    </div>
                </div>
            </div>
            <div class="p-2">
                <div class="p-2 d-flex align-items-end "><button id="btnModal" type="button"
                        class="btn btn-guardar  waves-effect waves-light fw-bold"><i
                            class="mdi mdi-plus-box-multiple-outline"></i> Agregar</button> </div>
            </div>
            <div class="p-2">
                <div class="p-2 d-flex align-items-end "><button type="button"
                        class="btn btn-guardar  waves-effect waves-light fw-bold btn-generate">Generar</button> </div>
            </div>
        </div>


        <div class="style-course text-white align-items-start">
            <div class="card-datatable table-responsive">
                <table class="datatables_enrollment table">
                    <thead class="text-white">
                        <tr>
                            <th></th>
                            <th class="text-white fw-bold">Código</th>
                            <th class="text-white fw-bold">Apellidos y Nombres</th>
                            <th class="text-nowrap text-white fw-bold">Capacitacion</th>
                            <th></th>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>


    <!-- Share Project Modal -->
    <div class="modal fade" id="shareProject" tabindex="-1">
        <div class="modal-dialog modal-lg modal-simple modal-enable-otp modal-dialog-centered">
            <div class="modal-content p-3 p-md-5">
                <div class="modal-body pt-3 pt-md-0">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    <div class="text-center">
                        <h3 class="mb-2">Estudiantes</h3>
                    </div>
                </div>
                <div class="col-12 mb-4 pb-2 text-dark">
                    <div class="form-floating form-floating-outline">
                        <select id="select2Multiple" class="select2 form-select" multiple="">
                        </select>
                        <label for="select2Multiple">Selecciona a los Integrantes</label>
                    </div>
                </div>
                <div class="d-flex align-items-start mt-4 align-items-sm-center">
                    <div class="d-flex justify-content-between flex-grow-1 align-items-center flex-wrap gap-2">
                        <button class="btn btn-success" id="addStudents">
                            Agregar a la tabla
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--/ Share Project Modal -->
@endsection()

@section('styles')
    <style>
        #dataConstancy {
            position: relative;
            overflow: hidden;
            max-width: 100%;
            /* Ajustar el ancho máximo */
        }
    </style>
@endsection()

@section('scripts')
    <script src="{{ asset('js/pages/generate_certificate.js') }}"></script>
@endsection
