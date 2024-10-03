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
        <div class="modal-dialog">
            <div style="right: 150px;width: 150% !important;" class="modal-content">
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
                            <div class="table-responsive text-nowrap">
                                <table class="table table-dark">
                                    <thead>
                                        <tr>
                                            <th>
                                                <font style="vertical-align: inherit;">
                                                    <font style="vertical-align: inherit;">Código</font>
                                                </font>
                                            </th>
                                            <th>
                                                <font style="vertical-align: inherit;">
                                                    <font style="vertical-align: inherit;">DNI-CI</font>
                                                </font>
                                            </th>
                                            <th>
                                                <font style="vertical-align: inherit;">
                                                    <font style="vertical-align: inherit;">Nombres y Apellidos
                                                    </font>
                                                </font>
                                            </th>
                                            <th>
                                                <font style="vertical-align: inherit;">
                                                    <font style="vertical-align: inherit;">Capacitacion</font>
                                                </font>
                                            </th>
                                            <th>
                                                <font style="vertical-align: inherit;">
                                                    <font style="vertical-align: inherit;">Nota</font>
                                                </font>
                                            </th>
                                            <th>
                                                <font style="vertical-align: inherit;">
                                                    <font style="vertical-align: inherit;">Email</font>
                                                </font>
                                            </th>
                                            <th>
                                                <font style="vertical-align: inherit;">
                                                    <font style="vertical-align: inherit;">Enlace</font>
                                                </font>
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td><i class="ri-suitcase-2-line ri-22px text-danger me-4"></i><span
                                                    class="fw-medium">
                                                    <font style="vertical-align: inherit;">
                                                        <font style="vertical-align: inherit;">Proyecto Tours
                                                        </font>
                                                    </font>
                                                </span></td>
                                            <td>
                                                <font style="vertical-align: inherit;">
                                                    <font style="vertical-align: inherit;">Albert Cook</font>
                                                </font>
                                            </td>
                                            <td>
                                                <ul class="list-unstyled m-0 avatar-group d-flex align-items-center">
                                                    <li data-bs-toggle="tooltip" data-popup="tooltip-custom"
                                                        data-bs-placement="top" class="avatar avatar-xs pull-up"
                                                        aria-label="Lilian Fuller" data-bs-original-title="Lilian Fuller">
                                                        <img src="../../assets/img/avatars/5.png" alt="Avatar"
                                                            class="rounded-circle">
                                                    </li>
                                                    <li data-bs-toggle="tooltip" data-popup="tooltip-custom"
                                                        data-bs-placement="top" class="avatar avatar-xs pull-up"
                                                        aria-label="Sofía Wilkerson"
                                                        data-bs-original-title="Sophia Wilkerson">
                                                        <img src="../../assets/img/avatars/6.png" alt="Avatar"
                                                            class="rounded-circle">
                                                    </li>
                                                    <li data-bs-toggle="tooltip" data-popup="tooltip-custom"
                                                        data-bs-placement="top" class="avatar avatar-xs pull-up"
                                                        aria-label="Cristina Parker"
                                                        data-bs-original-title="Christina Parker">
                                                        <img src="../../assets/img/avatars/7.png" alt="Avatar"
                                                            class="rounded-circle">
                                                    </li>
                                                </ul>
                                            </td>
                                            <td><span class="badge rounded-pill bg-label-primary me-1">
                                                    <font style="vertical-align: inherit;">
                                                        <font style="vertical-align: inherit;">Activo</font>
                                                    </font>
                                                </span></td>
                                            <td>
                                                <div class="dropdown">
                                                    <button type="button" class="btn p-0 dropdown-toggle hide-arrow"
                                                        data-bs-toggle="dropdown"><i class="ri-more-2-line"></i></button>
                                                    <div class="dropdown-menu">
                                                        <a class="dropdown-item waves-effect"
                                                            href="javascript:void(0);"><i class="ri-pencil-line me-1"></i>
                                                            Edit</a>
                                                        <a class="dropdown-item waves-effect"
                                                            href="javascript:void(0);"><i
                                                                class="ri-delete-bin-7-line me-1"></i> Delete</a>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td><i class="ri-basketball-fill ri-22px text-info me-4"></i><span
                                                    class="fw-medium">
                                                    <font style="vertical-align: inherit;">
                                                        <font style="vertical-align: inherit;">Proyecto deportivo
                                                        </font>
                                                    </font>
                                                </span></td>
                                            <td>
                                                <font style="vertical-align: inherit;">
                                                    <font style="vertical-align: inherit;">Cazador de Barry</font>
                                                </font>
                                            </td>
                                            <td>
                                                <ul class="list-unstyled m-0 avatar-group d-flex align-items-center">
                                                    <li data-bs-toggle="tooltip" data-popup="tooltip-custom"
                                                        data-bs-placement="top" class="avatar avatar-xs pull-up"
                                                        aria-label="Lilian Fuller" data-bs-original-title="Lilian Fuller">
                                                        <img src="../../assets/img/avatars/5.png" alt="Avatar"
                                                            class="rounded-circle">
                                                    </li>
                                                    <li data-bs-toggle="tooltip" data-popup="tooltip-custom"
                                                        data-bs-placement="top" class="avatar avatar-xs pull-up"
                                                        aria-label="Sofía Wilkerson"
                                                        data-bs-original-title="Sophia Wilkerson">
                                                        <img src="../../assets/img/avatars/6.png" alt="Avatar"
                                                            class="rounded-circle">
                                                    </li>
                                                    <li data-bs-toggle="tooltip" data-popup="tooltip-custom"
                                                        data-bs-placement="top" class="avatar avatar-xs pull-up"
                                                        aria-label="Cristina Parker"
                                                        data-bs-original-title="Christina Parker">
                                                        <img src="../../assets/img/avatars/7.png" alt="Avatar"
                                                            class="rounded-circle">
                                                    </li>
                                                </ul>
                                            </td>
                                            <td><span class="badge rounded-pill bg-label-success me-1">
                                                    <font style="vertical-align: inherit;">
                                                        <font style="vertical-align: inherit;">Terminado</font>
                                                    </font>
                                                </span></td>
                                            <td>
                                                <div class="dropdown">
                                                    <button type="button" class="btn p-0 dropdown-toggle hide-arrow"
                                                        data-bs-toggle="dropdown"><i class="ri-more-2-line"></i></button>
                                                    <div class="dropdown-menu">
                                                        <a class="dropdown-item waves-effect"
                                                            href="javascript:void(0);"><i class="ri-pencil-line me-1"></i>
                                                            Edit</a>
                                                        <a class="dropdown-item waves-effect"
                                                            href="javascript:void(0);"><i
                                                                class="ri-delete-bin-7-line me-1"></i> Delete</a>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td><i class="ri-leaf-fill ri-22px text-success me-4"></i><span
                                                    class="fw-medium">
                                                    <font style="vertical-align: inherit;">
                                                        <font style="vertical-align: inherit;">Proyecto de
                                                            invernadero
                                                        </font>
                                                    </font>
                                                </span></td>
                                            <td>
                                                <font style="vertical-align: inherit;">
                                                    <font style="vertical-align: inherit;">Trevor Panadero</font>
                                                </font>
                                            </td>
                                            <td>
                                                <ul class="list-unstyled m-0 avatar-group d-flex align-items-center">
                                                    <li data-bs-toggle="tooltip" data-popup="tooltip-custom"
                                                        data-bs-placement="top" class="avatar avatar-xs pull-up"
                                                        aria-label="Lilian Fuller" data-bs-original-title="Lilian Fuller">
                                                        <img src="../../assets/img/avatars/5.png" alt="Avatar"
                                                            class="rounded-circle">
                                                    </li>
                                                    <li data-bs-toggle="tooltip" data-popup="tooltip-custom"
                                                        data-bs-placement="top" class="avatar avatar-xs pull-up"
                                                        aria-label="Sofía Wilkerson"
                                                        data-bs-original-title="Sophia Wilkerson">
                                                        <img src="../../assets/img/avatars/6.png" alt="Avatar"
                                                            class="rounded-circle">
                                                    </li>
                                                    <li data-bs-toggle="tooltip" data-popup="tooltip-custom"
                                                        data-bs-placement="top" class="avatar avatar-xs pull-up"
                                                        aria-label="Cristina Parker"
                                                        data-bs-original-title="Christina Parker">
                                                        <img src="../../assets/img/avatars/7.png" alt="Avatar"
                                                            class="rounded-circle">
                                                    </li>
                                                </ul>
                                            </td>
                                            <td><span class="badge rounded-pill bg-label-info me-1">
                                                    <font style="vertical-align: inherit;">
                                                        <font style="vertical-align: inherit;">Programado</font>
                                                    </font>
                                                </span></td>
                                            <td>
                                                <div class="dropdown">
                                                    <button type="button" class="btn p-0 dropdown-toggle hide-arrow"
                                                        data-bs-toggle="dropdown"><i class="ri-more-2-line"></i></button>
                                                    <div class="dropdown-menu">
                                                        <a class="dropdown-item waves-effect"
                                                            href="javascript:void(0);"><i class="ri-pencil-line me-1"></i>
                                                            Edit</a>
                                                        <a class="dropdown-item waves-effect"
                                                            href="javascript:void(0);"><i
                                                                class="ri-delete-bin-7-line me-1"></i> Delete</a>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td><i class="ri-bank-fill ri-22px text-primary me-4"></i><span
                                                    class="fw-medium">
                                                    <font style="vertical-align: inherit;">
                                                        <font style="vertical-align: inherit;">Proyecto bancario
                                                        </font>
                                                    </font>
                                                </span></td>
                                            <td>
                                                <font style="vertical-align: inherit;">
                                                    <font style="vertical-align: inherit;">Jerry Milton</font>
                                                </font>
                                            </td>
                                            <td>
                                                <ul class="list-unstyled m-0 avatar-group d-flex align-items-center">
                                                    <li data-bs-toggle="tooltip" data-popup="tooltip-custom"
                                                        data-bs-placement="top" class="avatar avatar-xs pull-up"
                                                        aria-label="Lilian Fuller" data-bs-original-title="Lilian Fuller">
                                                        <img src="../../assets/img/avatars/5.png" alt="Avatar"
                                                            class="rounded-circle">
                                                    </li>
                                                    <li data-bs-toggle="tooltip" data-popup="tooltip-custom"
                                                        data-bs-placement="top" class="avatar avatar-xs pull-up"
                                                        aria-label="Sofía Wilkerson"
                                                        data-bs-original-title="Sophia Wilkerson">
                                                        <img src="../../assets/img/avatars/6.png" alt="Avatar"
                                                            class="rounded-circle">
                                                    </li>
                                                    <li data-bs-toggle="tooltip" data-popup="tooltip-custom"
                                                        data-bs-placement="top" class="avatar avatar-xs pull-up"
                                                        aria-label="Cristina Parker"
                                                        data-bs-original-title="Christina Parker">
                                                        <img src="../../assets/img/avatars/7.png" alt="Avatar"
                                                            class="rounded-circle">
                                                    </li>
                                                </ul>
                                            </td>
                                            <td><span class="badge rounded-pill bg-label-warning me-1">
                                                    <font style="vertical-align: inherit;">
                                                        <font style="vertical-align: inherit;">Pendiente</font>
                                                    </font>
                                                </span></td>
                                            <td>
                                                <div class="dropdown">
                                                    <button type="button" class="btn p-0 dropdown-toggle hide-arrow"
                                                        data-bs-toggle="dropdown"><i class="ri-more-2-line"></i></button>
                                                    <div class="dropdown-menu">
                                                        <a class="dropdown-item waves-effect"
                                                            href="javascript:void(0);"><i class="ri-pencil-line me-1"></i>
                                                            Edit</a>
                                                        <a class="dropdown-item waves-effect"
                                                            href="javascript:void(0);"><i
                                                                class="ri-delete-bin-7-line me-1"></i> Delete</a>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                    </tbody>
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
