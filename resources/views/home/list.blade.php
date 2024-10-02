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
                        @foreach ($programTypes as $programType)
                            <li class="nav-item" role="presentation">
                                <button type="button"
                                    class="nav-link waves-effect text-white @if ($loop->first) active @endif"
                                    role="tab" data-bs-toggle="tab"
                                    data-bs-target="#tab-{{ $programType->id_program_type }}"
                                    aria-controls="tab-{{ $programType->id_program_type }}"
                                    aria-selected="{{ $loop->first ? 'true' : 'false' }}">
                                    {{ $programType->name }}
                                </button>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
            <div class="card-body">
                <div class="tab-content p-0">
                    @foreach ($programTypes as $programType)
                        <div class="tab-pane fade @if ($loop->first) show active @endif"
                            id="tab-{{ $programType->id_program_type }}" role="tabpanel">
                            <!-- Filtros -->
                            <div class="d-flex flex-row mb-3 pt-3 justify-content-between text-white">
                                <!-- Aquí puedes añadir los filtros si es necesario -->
                            </div>

                            <!-- Contenido de cursos -->
                            @php
                                // Filtrar los cursos por el tipo de programa actual
                                $filteredCourses = $courses->filter(function ($course) use ($programType) {
                                    return $course->program_type_id == $programType->id_program_type;
                                });
                            @endphp

                            @if ($filteredCourses->isEmpty())
                                <div class="style-course text-white align-items-start">
                                    <div class="text-white">
                                        No hay cursos disponibles en este programa.
                                    </div>
                                </div>
                            @else
                                @foreach ($filteredCourses as $course)
                                    <div class="style-course text-white align-items-start">
                                        <div class="d-flex mb-3">
                                            <div class="d-flex flex-column mb-3 px-2 w-50">
                                                <div class="d-flex flex-row mb-3 font-programa">
                                                    <div class=" ">Programa:</div>
                                                    <div class="">{{ $programType->name }}</div>
                                                </div>
                                                <div class="nombr-cap">
                                                    {{ $course->course_or_event }}
                                                </div>
                                                <div class="sub-text">
                                                    Estudiantes: <span>Total: {{ $course->students_count }}</span>
                                                </div>
                                                <div class="sub-text">
                                                    Correos enviados: <span>{{ $course->emails_sent }}</span>
                                                </div>
                                            </div>
                                            <div class="ms-auto p-2 align-self-center btn-certi">
                                                <a class="text-white" href="{{ route('home.course', $course->code_course) }}">Ver</a>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            @endif
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
@endsection()

@section('styles')
@endsection()

@section('scripts')
@endsection
