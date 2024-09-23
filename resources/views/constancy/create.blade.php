@extends('Layout/App')

@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <p class="text-white px-5 fw-bold font-cat pt-3">Generar Constancia de Participación </p>
        <div class="d-flex flex-row mb-3">
            <div class="p-2">
                <div class="d-flex flex-column flex-sm-row justify-content-center text-center gap-5 fondo-cargacons">
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

                </div>
            </div>
            <div class="p-2 flex-column d-flex justify-content-center">

                <div class="p-2 ">
                    <div class="px-2">
                        <label for="smallInput" class="form-label text-white ">Nombre de la Capacitacion</label>
                        <input id="smallInput" class="form-control form-control-sm bg-input w-420" type="text"
                            placeholder="">
                    </div>
                </div>




                <div class="p-2 ">
                    <div class="mb-3 px-2">
                        <label for="defaultSelect" class="form-label text-white">Programa</label>
                        <select id="defaultSelect" class="form-select">
                            <option>Seleccionar</option>
                            <option value="1">Curso</option>
                            <option value="2">Especializacion</option>
                            <option value="3">Diplomado</option>
                        </select>
                    </div>

                </div>

            </div>

        </div>

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
                <div class="p-2 d-flex align-items-end "><button type="button"
                        class="btn btn-guardar  waves-effect waves-light fw-bold">Importar</button></div>
            </div>
        </div>


        <div class="  style-course text-white align-items-start">
            <div class="table-responsive text-nowrap">
                <table class="table ">
                    <thead>
                        <tr>
                            <th class="text-white fw-bold">Código</th>
                            <th class="text-white fw-bold">Nombre</th>
                            <th class="text-white fw-bold">Capacitacion</th>
                            <th class="text-white fw-bold">Descripcion</th>
                            <th class="text-white fw-bold">Acciones</th>

                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>123456k</td>
                            <td><span class="fw-medium">Tours Project</span></td>
                            <td>Albert Cook</td>
                            <td>Realizado desde el 17 de marzo del 2024 al 20 de junio del 2024</td>
                            <td>
                                <div class="dropdown">
                                    <button type="button" class="btn p-0 dropdown-toggle hide-arrow"
                                        data-bs-toggle="dropdown"><i class="mdi mdi-dots-vertical"></i></button>
                                    <div class="dropdown-menu">
                                        <a class="dropdown-item waves-effect" href="javascript:void(0);"><i
                                                class="mdi mdi-pencil-outline me-1"></i> Edit</a>
                                        <a class="dropdown-item waves-effect" href="javascript:void(0);"><i
                                                class="mdi mdi-trash-can-outline me-1"></i> Delete</a>
                                    </div>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>fg5982</td>
                            <td><span class="fw-medium">Tours Project</span></td>
                            <td>Albert Cook</td>
                            <td>Realizado desde el 17 de marzo del 2024 al 20 de junio del 2024</td>
                            <td>
                                <div class="dropdown">
                                    <button type="button" class="btn p-0 dropdown-toggle hide-arrow"
                                        data-bs-toggle="dropdown"><i class="mdi mdi-dots-vertical"></i></button>
                                    <div class="dropdown-menu">
                                        <a class="dropdown-item waves-effect" href="javascript:void(0);"><i
                                                class="mdi mdi-pencil-outline me-1"></i> Edit</a>
                                        <a class="dropdown-item waves-effect" href="javascript:void(0);"><i
                                                class="mdi mdi-trash-can-outline me-1"></i> Delete</a>
                                    </div>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>1uf59687</td>
                            <td><span class="fw-medium">Tours Project</span></td>
                            <td>Albert Cook</td>
                            <td>Realizado desde el 17 de marzo del 2024 al 20 de junio del 2024</td>
                            <td>
                                <div class="dropdown">
                                    <button type="button" class="btn p-0 dropdown-toggle hide-arrow"
                                        data-bs-toggle="dropdown"><i class="mdi mdi-dots-vertical"></i></button>
                                    <div class="dropdown-menu">
                                        <a class="dropdown-item waves-effect" href="javascript:void(0);"><i
                                                class="mdi mdi-pencil-outline me-1"></i> Edit</a>
                                        <a class="dropdown-item waves-effect" href="javascript:void(0);"><i
                                                class="mdi mdi-trash-can-outline me-1"></i> Delete</a>
                                    </div>
                                </div>
                            </td>
                        </tr>

                    </tbody>
                </table>
            </div>
            <div class="row">
                <div class="col-sm-12 col-md-6">
                    <div class="dataTables_info" id="DataTables_Table_2_info" role="status" aria-live="polite">Showing
                        0 to 0 of 0 entries</div>
                </div>
                <div class="col-sm-12 col-md-6 dataTables_pager">
                    <div class="dataTables_paginate paging_simple_numbers" id="DataTables_Table_2_paginate">
                        <ul class="pagination d-flex justify-content-end">
                            <li class="paginate_button page-item previous disabled" id="DataTables_Table_2_previous">
                                <a aria-controls="DataTables_Table_2" aria-disabled="true" role="link"
                                    data-dt-idx="previous" tabindex="0" class="page-link bg-transparent">Previous</a>
                            </li>
                            <li class="paginate_button page-item next disabled" id="DataTables_Table_2_next"><a
                                    aria-controls="DataTables_Table_2" aria-disabled="true" role="link"
                                    data-dt-idx="next" tabindex="0" class="page-link bg-transparent">Next</a></li>
                        </ul>
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
