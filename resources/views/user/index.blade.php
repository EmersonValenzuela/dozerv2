@extends('Layout/App')

@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="content-wrapper py-5" style="flex: 0.6 !important;">

            <div class="text-white px-5 fw-bold font-tituview">
                Lista de Usuarios
            </div>
            <div class="d-flex mb-3">



                <div class="ms-auto d-flex  mx-5 align-self-start align-self-center  style-btntwo">
                    <button type="button" class="btn color-btntwo modal_add">
                        Agregar Usuario
                    </button>
                </div>
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
                                <th class="text-white fw-bold">id</th>
                                <th class="text-white fw-bold">Usuario</th>
                                <th class="text-white fw-bold">Correo</th>
                                <th class="text-white fw-bold">Rol</th>
                                <th class="text-white fw-bold"></th>
                            </tr>

                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="modal_user" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header text-center">
                    <h1 class="modal-title fs-5 text-white " id="modal_title">NUEVO USUARIO</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="form_student">
                        <input type="hidden" name="user_id" id="user_id" value="">
                        <div class="d-flex flex-row mb-3 justify-content-between">
                            <div class="px-2 w-100">
                                <label for="smallInput" class="form-label ">Nombres y apellidos:</label>
                                <input id="names" name="names" class="form-control form-control-sm bg-input"
                                    type="text" placeholder="">
                            </div>
                        </div>
                        <div class="d-flex flex-row mb-3 justify-content-between">

                            <div class="px-2 w-50">
                                <label for="smallInput" class="form-label ">Correo Electronico:</label>
                                <input id="email" name="email" class="form-control form-control-sm bg-input"
                                    type="text" placeholder="">
                            </div>
                            <div class="px-2 w-50">
                                <label for="smallInput" class="form-label ">Contraseña:</label>
                                <input id="password" name="password" class="form-control form-control-sm bg-input"
                                    type="text" placeholder="">
                            </div>
                        </div>

                        <div class="modal-footer">
                            <button type="button" class="btn btn-cancelar " data-bs-dismiss="modal">Cancelar</button>
                            <button type="submit" class="btn btn-guardar ">Guardar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection()

@section('styles')
@endsection()

@section('scripts')

    <script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.16.9/xlsx.full.min.js"></script>
    <script src="{{ asset('js/pages/user_list.js') }}"></script>
@endsection
