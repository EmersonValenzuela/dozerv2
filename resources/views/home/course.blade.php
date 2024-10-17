@extends('Layout/App')

@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="content-wrapper py-5" style="flex: 0.6 !important;">

            <div class="text-white px-5 fw-bold font-tituview">{{ $course->course_or_event }}</div>
            <div class="d-flex mb-3">
                <div class="d-flex flex-row  px-5   fw-light text-plo">
                    <div class="p-2"> <span class="mdi mdi-calendar-month-outline"></span> Fecha de Registro
                        {{ $course->dateFinish }}
                    </div>
                    <div class="p-2"> <span class="mdi mdi-account-school"></span> Estudiantes:
                        {{ $course->students_count }}</div>

                </div>


                <div class="ms-auto d-flex  mx-5 align-self-start align-self-center  style-btntwo">
                    <button type="button" class="btn color-btntwo " data-bs-toggle="modal" data-bs-target="#exampleModal">
                        Agregar Estudiantes
                    </button>
                </div>
            </div>

            <div class="p-2 mx-5 align-self-start align-items-center style-btntwo ">
                <button type="button" class="btn color-btntwo " data-bs-toggle="modal" data-bs-target="#exampleModal2">
                    Carga Masiva
                </button>
            </div>




            <div class="d-flexg-2 align-items-center pt-3 ">
                <div class="d-flex flex-row px-5 pb-3">
                    <div class="input-wrapper  me-3">
                        <input type="search" id="referralLink" name="referralLink" class=" bg-input "
                            placeholder=" Buscar por Nombre o Código">
                        <span class="mdi mdi-magnify input-icon"></span>
                    </div>
                </div>
            </div>

            <div class="style-course text-white align-items-start">
                <div class="card-datatable text-nowrap">
                    <table class="dt-students table">
                        <thead class="text-white">
                            <tr>
                                <th class="text-white fw-bold" rowspan="2">Estudiante</th>
                                <th class="text-white fw-bold" rowspan="2">Correo</th>
                                <th class="text-white fw-bold text-center" colspan="5">Documentos Adjuntos</th>
                                <th class="text-white fw-bold" rowspan="2">Acciones</th>
                            </tr>
                            <tr>
                                <th class="text-white fw-bold text-center">C. Matricula</th>
                                <th class="text-white fw-bold text-center">C. Participación</th>
                                <th class="text-white fw-bold text-center">R. Excelencia</th>
                                <th class="text-white fw-bold text-center">C. Curso</th>
                                <th class="text-white fw-bold text-center">P. Webinar</th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header text-center">
                    <h1 class="modal-title fs-5 text-white " id="exampleModalLabel">NUEVO ESTUDIANTE</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="d-flex flex-row mb-3 justify-content-between">
                        <div class="px-2 w-100">
                            <label for="smallInput" class="form-label ">Nombres y apellidos:</label>
                            <input id="smallInput" class="form-control form-control-sm bg-input" type="text"
                                placeholder="">
                        </div>
                    </div>
                    <div class="d-flex flex-row mb-3 justify-content-between">
                        <div class="px-2 w-50">
                            <label for="smallInput" class="form-label ">DNI:</label>
                            <input id="smallInput" class="form-control form-control-sm bg-input" type="text"
                                placeholder="">
                        </div>
                        <div class="px-2 w-50">
                            <label for="smallInput" class="form-label ">Correo Electronico:</label>
                            <input id="smallInput" class="form-control form-control-sm bg-input" type="text"
                                placeholder="">
                        </div>
                    </div>
                    <div class="d-flex">
                        <div class="p-2"><label for="smallInput" class="form-label ">Nota:</label>
                            <input id="smallInput" class="form-control form-control-sm bg-input" type="text"
                                placeholder="">
                        </div>
                        <div class="p-2 flex-grow-1"><label for="smallInput" class="form-label ">Nombre de la
                                Capacitación:</label>
                            <input id="smallInput" class="form-control form-control-sm bg-input" type="text"
                                placeholder="">
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-cancelar " data-bs-dismiss="modal">Cancelar</button>
                    <button type="button" class="btn btn-guardar ">Guardar</button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="exampleModal2" tabindex="-2" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl modal-simple">
            <div class="modal-content">
                <div class="modal-header text-center">
                    <h1 class="modal-title fs-5 text-white fw-bold " id="exampleModalLabel1">CARGA MASIVA</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="d-flex flex-row mb-3 justify-content-between">
                        <div class="px-2 w-50 d-flex align-items-center">
                            <div class="row g-2 align-items-center ">

                                <div class="input-wrapper  me-3">
                                    <input type="search" id="referralLink" name="referralLink" class=" bg-input "
                                        placeholder=" Buscar por Nombre o Código">
                                    <span class="mdi mdi-magnify input-icon"></span>
                                </div>

                            </div>
                        </div>
                        <div class="px-2 w-50 d-flex flex-row justify-content-end">
                            <button type="button" class="btn btn-cancelar " data-bs-dismiss="modal">IMPORTAR</button>
                            <button type="button" class="btn btn-guardar ">GUARDAR</button>
                        </div>
                    </div>
                    <div class="d-flex flex-row mb-3 justify-content-between">
                        <div class="px-2 w-100">
                            <div class="card-datatable table-responsive">
                                <table class="datatables_certificates table">
                                    <thead class="text-white">
                                        <tr>
                                            <th></th>
                                            <th class="text-white fw-bold">Código</th>
                                            <th class="text-nowrap text-white fw-bold">DNI-CI</th>
                                            <th class="text-white fw-bold">Apellidos y Nombres</th>
                                            <th class="text-nowrap text-white fw-bold">Capacitacion</th>
                                            <th class="text-white fw-bold">Nota </th>
                                            <th class="text-white fw-bold">Correo Electronico </th>
                                            <th class="text-white fw-bold">Acciones</th>
                                        </tr>
                                    </thead>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection()

@section('styles')
@endsection()

@section('scripts')
    <script>
        const course_id = {{ $course->id_course }};
    </script>
    <script src="{{ asset('js/pages/course.js') }}"></script>
@endsection
