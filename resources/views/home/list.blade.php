@extends('Layout/App')

@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="d-flex justify-content-star">
            <h5 class="mb-3 text-nowrap text-white">
                COLEGIO DE INGENIEROS DEL PERÚ
            </h5>
        </div>
        <div class="mb-4">
            <div class="card-header p-0">
                <div class="nav-align-top">
                    <ul class="nav nav-tabs nav-fill border border-0" role="tablist">
                        <li class="nav-item" role="presentation">
                            <button type="button" class="nav-link waves-effect text-white active" role="tab"
                                data-bs-toggle="tab" data-bs-target="#navs-justified-profile"
                                aria-controls="navs-justified-profile" aria-selected="false" tabindex="-1">
                                Especializaciones
                            </button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button type="button" class="nav-link waves-effect text-white" role="tab"
                                data-bs-toggle="tab" data-bs-target="#navs-justified-messages"
                                aria-controls="navs-justified-messages" aria-selected="true">
                                Diplomados
                            </button>
                        </li>
                        <span class="tab-slider" style="left: 387.663px; width: 205.925px; bottom: 0px"></span>
                    </ul>
                </div>
            </div>
            <div class="card-body">
                <div class="tab-content p-0">
                    <div class="tab-pane fade" id="navs-justified-profile" role="tabpanel">
                        <!--Inicio de Filtros -->
                        <div class="d-flex flex-row mb-3 pt-3 justify-content-between text-white">
                            <div class="form-check mb-3">
                                <input class="form-check-input select-all" type="checkbox" id="selectAll" data-value="all"
                                    checked="" />
                                <label class="form-check-label text-plo" for="selectAll">Ver todo</label>
                            </div>

                            <div class="form-check mb-3">
                                <input class="form-check-input input-filter" type="checkbox" id="select-personal"
                                    data-value="personal" checked="" />
                                <label class="form-check-label" for="select-personal">Certificados</label>
                            </div>
                            <div class="form-check mb-3">
                                <input class="form-check-input input-filter" type="checkbox" id="select-business"
                                    data-value="business" checked="" />
                                <label class="form-check-label" for="select-business">Constancia de Matricula</label>
                            </div>
                            <div class="form-check mb-3">
                                <input class="form-check-input input-filter" type="checkbox" id="select-family"
                                    data-value="family" checked="" />
                                <label class="form-check-label" for="select-family">Constancia de Participacion</label>
                            </div>
                            <div class="form-check mb-3">
                                <input class="form-check-input input-filter" type="checkbox" id="select-holiday"
                                    data-value="holiday" checked="" />
                                <label class="form-check-label" for="select-holiday">Reconocimiento a la Excelencia</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input input-filter" type="checkbox" id="select-etc"
                                    data-value="etc" checked="" />
                                <label class="form-check-label" for="select-etc">Participacion en Webinar</label>
                            </div>
                        </div>
                        <!--Final de Filtros -->
                        <!--Contenido de cursos -->
                        <div class="style-course text-white align-items-start">
                            <div class="d-flex mb-3">
                                <div class="d-flex flex-column mb-3 px-2 w-50">
                                    <div class="">
                                        <div class="d-flex flex-row mb-3 font-programa">
                                            <div class=" ">Programa:</div>
                                            <div class="">CURSO</div>
                                        </div>
                                    </div>
                                    <div class="nombr-cap">
                                        TITULO DEL ESPECIALIZACION
                                    </div>
                                    <div class="sub-text">
                                        Estudiantes: <span>Total: 40</span>
                                    </div>
                                    <div class="sub-text">
                                        Correos enviados: <span>0</span>
                                    </div>
                                </div>

                                <div class="ms-auto p-2 align-self-center btn-certi">
                                    <a class="text-white" href="view-certificate.html">Ver</a>
                                </div>
                            </div>
                        </div>

                        <!--Contenido de cursos -->
                    </div>
                    <div class="tab-pane fade active show" id="navs-justified-messages" role="tabpanel">
                        <!--Inicio de Filtros -->
                        <div class="d-flex flex-row mb-3 pt-3 justify-content-between text-white">
                            <div class="form-check mb-3">
                                <input class="form-check-input select-all" type="checkbox" id="selectAll"
                                    data-value="all" checked="" />
                                <label class="form-check-label text-plo" for="selectAll">Ver todo</label>
                            </div>

                            <div class="form-check mb-3">
                                <input class="form-check-input input-filter" type="checkbox" id="select-personal"
                                    data-value="personal" checked="" />
                                <label class="form-check-label" for="select-personal">Certificados</label>
                            </div>
                            <div class="form-check mb-3">
                                <input class="form-check-input input-filter" type="checkbox" id="select-business"
                                    data-value="business" checked="" />
                                <label class="form-check-label" for="select-business">Constancia de Matricula</label>
                            </div>
                            <div class="form-check mb-3">
                                <input class="form-check-input input-filter" type="checkbox" id="select-family"
                                    data-value="family" checked="" />
                                <label class="form-check-label" for="select-family">Constancia de Participacion</label>
                            </div>
                            <div class="form-check mb-3">
                                <input class="form-check-input input-filter" type="checkbox" id="select-holiday"
                                    data-value="holiday" checked="" />
                                <label class="form-check-label" for="select-holiday">Reconocimiento a la
                                    Excelencia</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input input-filter" type="checkbox" id="select-etc"
                                    data-value="etc" checked="" />
                                <label class="form-check-label" for="select-etc">Participacion en Webinar</label>
                            </div>
                        </div>
                        <!--Final de Filtros -->
                        <!--Contenido de cursos -->
                        <div class="style-course text-white align-items-start">
                            <div class="d-flex mb-3">
                                <div class="d-flex flex-column mb-3 px-2 w-50">
                                    <div class="">
                                        <div class="d-flex flex-row mb-3 font-programa">
                                            <div class=" ">Programa:</div>
                                            <div class="">CURSO</div>
                                        </div>
                                    </div>
                                    <div class="nombr-cap">TITULO DEL DIPLOMADO</div>
                                    <div class="sub-text">
                                        Estudiantes: <span>Total: 40</span>
                                    </div>
                                    <div class="sub-text">
                                        Correos enviados: <span>0</span>
                                    </div>
                                </div>

                                <div class="ms-auto p-2 align-self-center btn-certi">
                                    <a class="text-white" href="view-certificate.html">Ver</a>
                                </div>
                            </div>
                        </div>

                        <!--Contenido de cursos -->
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection()

@section('styles')
@endsection()

@section('scripts')
@endsection
