@extends('Layout/App')

@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">

        <p class="text-white px-5 fw-bold font-cat pt-3">Generar Constancia de Matricula </p>
        <div class="row" id="dataConstancy">
            <div class="col-12">
                <div class="card mb-4 style-course">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6 mb-4">
                                <div class="form-floating form-floating-outline form-floating-select2">
                                    <div class="position-relative">
                                        <select id="course" class=" form-select">
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
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
