@extends('Layout/App')

@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">

        <p class="text-white px-5 fw-bold font-cat pt-3">Generar Constancia de participación en Webinar </p>
        <div class="row">
            <div class="col-xl-3 col-md-8 col-12 mb-md-0 mb-4">
                <div class="card bg-dark">
                    <div class="card-body">
                        <!-- Vendor -->
                        <div class="mb-3 col ecommerce-select2-dropdown">
                            <div class="form-floating form-floating-outline">
                                <select id="vendor" class="select2 form-select"
                                    data-placeholder="Seleccionar tipo certificado">
                                    <option value="">Seleccionar tipo capacitación</option>
                                    <option value="men-clothing">Dozer</option>
                                    <option value="women-clothing">CIP</option>
                                    <option value="kid-clothing">CAP</option>
                                    <option value="kid-clothing">WEBINAR</option>
                                </select>
                                <label for="vendor">TIPO CERTIFICADO</label>
                            </div>
                        </div>
                        <!-- Collection -->
                        <div class="mb-4 col ecommerce-select2-dropdown">
                            <div class="form-floating form-floating-outline">
                                <select id="collection" class="select2 form-select" data-placeholder="Seleccionar programa">
                                    <option value="">Seleccionar programa</option>
                                    <option value="men-clothing">Curso</option>
                                    <option value="women-clothing">Especializacion</option>
                                    <option value="kid-clothing">Diplomado</option>
                                </select>
                                <label for="collection">PROGRAMA</label>
                            </div>
                        </div>
                        <!-- Status -->
                        <div class="mb-4 col ecommerce-select2-dropdown">
                            <div class="form-floating form-floating-outline">
                                <select id="status-org" class="select2 form-select" data-placeholder="Seleccionar Curso">
                                    <option value="">Seleccionar Curso</option>
                                    <option value="Published">curso 1</option>
                                    <option value="Scheduled">curso 2</option>
                                    <option value="Inactive">curso 3</option>
                                </select>
                                <label for="status-org">Status</label>
                            </div>
                        </div>

                        <!-- Status -->
                        <div class="mb-4 col ecommerce-select2-dropdown">
                            <div class="form-floating form-floating-outline">
                                <select id="certificate" class="select2 form-select" data-placeholder="Seleccionar Certificado">
                                    <option value="">Seleccionar certificado</option>
                                    <option value="Published">Matricula</option>
                                    <option value="Scheduled">Participacion</option>
                                    <option value="Inactive">Excelencia</option>
                                    <option value="Inactive">Webinar</option>
                                </select>
                                <label for="certificate">Status</label>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
            <div class="col-xl-9 col-md-8 col-12 mb-md-0 mb-4">

                <div class="card style-course">

                    <div class="d-flex">
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
                                    class="btn btn-guardar  waves-effect waves-light fw-bold btn-generate">Agregar</button>
                            </div>
                        </div>

                        <div class="p-2">
                            <div class="p-2 d-flex align-items-end ">
                                <button type="button" class=" btn-import waves-effect waves-light "
                                    id="btnImport">Enviar</button>
                            </div>
                        </div>
                    </div>

                    <input type="file" id="excelFile" style="display: none;" accept=".xlsx, .xls">

                    <div class="style-course text-white align-items-start">
                        <div class="card-datatable table-responsive">
                            <table class="datatables_certificates table">
                                <thead class="text-white">
                                    <tr>
                                        <th></th>
                                        <th></th>
                                        <th class="text-nowrap text-white fw-bold">DNI-CI</th>
                                        <th class="text-white fw-bold">Apellidos y Nombres</th>
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
@endsection()

@section('styles')
@endsection()

@section('scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.16.9/xlsx.full.min.js"></script>
    <script src="{{ asset('js/pages/sendmails.js') }}"></script>
@endsection
