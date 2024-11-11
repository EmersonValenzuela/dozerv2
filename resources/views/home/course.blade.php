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
                    <button type="button" class="btn color-btntwo " id="btnModalAdd">
                        Agregar Estudiante
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
                                <th class="text-white fw-bold text-center" colspan="4">Documentos Adjuntos</th>
                                <th class="text-white fw-bold" rowspan="2">Acciones</th>
                            </tr>
                            <tr>
                                <th class="text-white fw-bold text-center">C. Matricula</th>
                                <th class="text-white fw-bold text-center">C. Participación</th>
                                <th class="text-white fw-bold text-center">R. Excelencia</th>
                                <th class="text-white fw-bold text-center">C. Curso</th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="modal_student" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header text-center">
                    <h1 class="modal-title fs-5 text-white " id="modal_title"></h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form id="form_student">
                    <div class="modal-body">
                        <p class="pt-1" id="modal_subtitle"></p>
                        <div class="d-flex flex-row mb-3 justify-content-between">
                            <input type="hidden" id="code" name="code">
                            <input type="hidden" name="imgUrl" id="imgUrl">
                            <input type="hidden" name="imgUrl2" id="imgUrl2">
                            <input type="hidden" id="certificate" name="certificate">
                            <input type="hidden" id="course_id" name="course_id">
                            <input type="hidden" id="student_id" name="student_id">
                            <div class="px-2 w-100">
                                <label for="smallInput" class="form-label ">Nombres y apellidos:</label>
                                <input id="names" name="names" class="form-control form-control-sm bg-input"
                                    type="text" placeholder="">
                            </div>
                        </div>
                        <div class="d-flex flex-row mb-3 justify-content-between">
                            <div class="px-2 w-50">
                                <label for="smallInput" class="form-label ">DNI:</label>
                                <input id="document" name="document" class="form-control form-control-sm bg-input"
                                    type="text" placeholder="">
                            </div>
                            <div class="px-2 w-50">
                                <label for="smallInput" class="form-label ">Correo Electronico:</label>
                                <input id="email" name="email" class="form-control form-control-sm bg-input"
                                    type="text" placeholder="">
                            </div>
                        </div>
                        <div class="d-flex">
                            <div class="p-2"><label for="smallInput" class="form-label ">Nota:</label>
                                <input id="score" name="score" class="form-control form-control-sm bg-input"
                                    type="text" placeholder="">
                            </div>
                            <div class="p-2 flex-grow-1"><label for="smallInput" class="form-label ">Nombre de la
                                    Capacitación:</label>
                                <input id="course_name" name="course_name" class="form-control form-control-sm bg-input"
                                    type="text" placeholder="">
                            </div>
                        </div>
                        <div class="d-flex">
                            <div class="p-2 flex-grow-1"><label for="smallInput" class="form-label ">Fecha:</label>
                                <input id="course_date" name="course_date" class="form-control form-control-sm bg-input"
                                    type="text" placeholder="">
                            </div>
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
                                    <input type="search" id="referralImport" name="referralImport" class=" bg-input "
                                        placeholder=" Buscar por Nombre o Código">
                                    <span class="mdi mdi-magnify input-icon"></span>
                                </div>

                            </div>
                        </div>
                        <div class="px-2 w-50 d-flex flex-row justify-content-end">
                            <button type="button" class=" btn-import waves-effect waves-light "
                                id="btnImport">Importar</button>
                            <input type="file" id="excelFile" style="display: none;" accept=".xlsx, .xls">

                            <button type="button" class="btn btn-guardar btn-generate">GUARDAR</button>
                        </div>
                    </div>
                    <div class="d-flex flex-row mb-3 justify-content-between">
                        <div class="px-2 w-100">
                            <div class="card-datatable table-responsive">
                                <table class="datatables_add table">
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
        const enrollmentUrl = "{{ asset('pdfs/enrollments/') }}";
        const constancyUrl = "{{ asset('pdfs/constancy/') }}";
        const recognitionUrl = "{{ asset('pdfs/recognition/') }}";
        const certificateUrl = "{{ asset('pdfs/certificates/') }}";

        //images background 
        const img1 = "{{ $course->image_one }}";
        const img2 = "{{ $course->image_two }}";
        const img1cm = "{{ $course->image_cm }}";
        const imgcp = "{{ $course->image_cp }}";
        const imgre = "{{ $course->image_re }}";


        const baseUrl = "{{ url('/') }}";
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.16.9/xlsx.full.min.js"></script>
    <script src="{{ asset('js/pages/course.js') }}"></script>
@endsection
