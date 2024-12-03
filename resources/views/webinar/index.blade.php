@extends('Layout/App')

@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="d-flex justify-content-star">
            <h5 class="mb-3 text-nowrap text-white">
                COLEGIO DE INGENIEROS DEL PERÚ
            </h5>
        </div>
        <div class="mb-4">
            <div class="card-body">
                <div class="tab-content p-0">
                    <div class="tab-pane show active " role="tabpanel">
                        <!-- Filtros -->
                        <div class="d-flex flex-row mb-3 pt-3 justify-content-between text-white">
                            <!-- Aquí puedes añadir los filtros si es necesario -->
                        </div>

                        @if ($courses->isEmpty())
                            <div class="style-course text-white align-items-start">
                                <div class="text-white">
                                    No hay existen webinars.
                                </div>
                            </div>
                        @else
                            @foreach ($courses as $course)
                                <div class="style-course text-white align-items-start">
                                    <div class="d-flex mb-3">
                                        <div class="d-flex flex-column mb-3 px-2 w-50">

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
                                            <a class="text-white"
                                                href="{{ route('webinar.show', $course->code_course) }}">Ver</a>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        @endif
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
