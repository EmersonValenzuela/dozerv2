@extends('Layout/App')

@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">

        <p class="text-white px-5 fw-bold font-cat pt-3">Generar Constancia de participación en Webinar </p>
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
                        <label for="title" class="form-label text-white ">Nombre del Webinar</label>
                        <input id="title" class="form-control form-control-sm bg-input w-420" type="text"
                            placeholder="">
                    </div>
                </div>
                <div class="p-2 ">
                    <div class="px-2">
                        <label for="date" class="form-label text-white ">Descripción del Webinar</label>
                        <input id="date" class="form-control form-control-sm bg-input w-420" type="text"
                            placeholder="">
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
                        class="btn btn-guardar  waves-effect waves-light fw-bold btn-generate">Generar</button> </div>
            </div>

            <div class="p-2">
                <div class="p-2 d-flex align-items-end ">
                    <button type="button" class=" btn-import waves-effect waves-light " id="btnImport">Importar</button>
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
@endsection()

@section('styles')
@endsection()

@section('scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.16.9/xlsx.full.min.js"></script>
    <script src="{{ asset('js/pages/webinar.js') }}"></script>
@endsection
