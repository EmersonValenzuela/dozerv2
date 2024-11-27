@extends('Layout/App')

@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">

        <p class="text-white px-5 fw-bold font-cat pt-3">Enviar Correos</p>
        <div class="row">
            <div class="col-xl-3 col-md-8 col-12 mb-md-0 mb-4">
                <div class="card bg-dark">
                    <div class="card-body">
                        <form id="filterMails">
                            <!-- Vendor -->
                            <div class="mb-3 col ecommerce-select2-dropdown">
                                <div class="form-floating form-floating-outline">
                                    <select id="type_txt" name="type_txt" class="select2 form-select"
                                        data-placeholder="Seleccionar tipo certificado">
                                        <option value="">Seleccionar tipo capacitación</option>
                                        @foreach ($types as $type)
                                            <option value="{{ $type->id_certificate_type }}">{{ $type->name }}</option>
                                        @endforeach
                                    </select>
                                    <label for="type_txt">Tipos Certificados</label>
                                </div>
                            </div>
                            <!-- Collection -->
                            <div class="mb-4 col ecommerce-select2-dropdown">
                                <div class="form-floating form-floating-outline">
                                    <select id="program_txt" name="program_txt" class="select2 form-select"
                                        data-placeholder="Seleccionar programa">
                                        <option value="">Seleccionar programa</option>

                                    </select>
                                    <label for="program_txt">Programas</label>
                                </div>
                            </div>
                            <!-- Status -->
                            <div class="mb-4 col ecommerce-select2-dropdown">
                                <div class="form-floating form-floating-outline">
                                    <select id="course_txt" name="course_txt" class="select2 form-select"
                                        data-placeholder="Seleccionar Curso">
                                    </select>
                                    <label for="course_txt">Cursos</label>
                                </div>
                            </div>

                            <!-- Status -->
                            <div class="mb-4 col ecommerce-select2-dropdown">
                                <div class="form-floating form-floating-outline">
                                    <select id="certificate_txt" name="certificate_txt" class="select2 form-select"
                                        data-placeholder="Seleccionar Certificado">
                                        <option value="">Seleccionar certificado</option>
                                        <option value="c_m">C. Matricula</option>
                                        <option value="c_p">C. Participación</option>
                                        <option value="r_e">R. Excelencia</option>
                                        <option value="certificate">C. Curso</option>
                                        <option value="w_p">Webinar</option>
                                    </select>
                                    <label for="certificate_txt">Certificados</label>
                                </div>
                            </div>

                            <div class="mb-4">
                                <button type="submit" class="btn btn-guardar  waves-effect waves-light fw-bold"><i
                                        class="mdi mdi-refresh"></i> INGRESAR</button>
                            </div>
                        </form>
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
                            <div class="p-2 d-flex align-items-end ">
                                <button type="button" class=" btn-import waves-effect waves-light "
                                    id="send_mails">Enviar</button>
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
                                        <th></th>
                                        <th class="text-white fw-bold">Estado</th>
                                        <th class="text-white fw-bold">Acciones</th>
                                    </tr>
                                </thead>
                            </table>
                            <tbody>

                            </tbody>
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
