@extends('Layout/App')

@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="d-flex justify-content-star">
            <h5 class="mb-3 text-nowrap text-white">
                {{$typeCertificate->description}}
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
                            <!-- Filtro -->
                            <div class="d-flex flex-row mb-3 pt-3 justify-content-start align-items-center text-white">
                                <input type="text" class="form-control form-control-lg w-25 me-3 filter-input"
                                    placeholder="Filtrar ..." data-tab="{{ $programType->id_program_type }}">
                            </div>

                            <!-- Contenido de cursos -->
                            @php
                                $filteredCourses = $courses->filter(function ($course) use ($programType) {
                                    return $course->program_type_id == $programType->id_program_type;
                                });
                            @endphp

                            <div class="courses-container">
                                @if ($filteredCourses->isEmpty())
                                    <div class="style-course text-white align-items-start no-courses-message">
                                        <div class="text-white">
                                            No hay cursos disponibles en este programa.
                                        </div>
                                    </div>
                                @else
                                    @foreach ($filteredCourses as $course)
                                        <div class="style-course text-white align-items-start course-item"
                                            data-name="{{ strtolower($course->course_or_event) }}">
                                            <div class="d-flex mb-3">
                                                <div class="d-flex flex-column mb-3 px-2 w-50">
                                                    <div class="d-flex flex-row mb-3 font-programa">
                                                        <div class="">Programa: &nbsp;</div>
                                                        <div class=""> {{ $programType->name }}</div>
                                                    </div>
                                                    <div class="nombr-cap">
                                                        {{ $course->course_or_event }}
                                                    </div>
                                                    <div class="sub-text">
                                                        Estudiantes: <span>Total: {{ $course->students_count }}</span>
                                                    </div>
                                                    <div class="sub-text">
                                                        Fecha: <span>{{ $course->created_at->format('d/m/Y') }}</span>
                                                    </div>
                                                </div>
                                                <div class="ms-auto p-2 align-self-center btn-certi">
                                                    <a class="text-white"
                                                        href="{{ route('home.course', $course->code_course) }}">Ver</a>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                @endif
                            </div>
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
    <script>
        document.querySelectorAll('.filter-input').forEach(input => {
            input.addEventListener('input', function() {
                const filterValue = this.value.toLowerCase();
                const tabId = this.getAttribute('data-tab');
                const coursesContainer = document.querySelector(`#tab-${tabId} .courses-container`);
                const courseItems = coursesContainer.querySelectorAll('.course-item');
                let visibleCount = 0;

                courseItems.forEach(course => {
                    const courseName = course.getAttribute('data-name');
                    if (courseName.includes(filterValue)) {
                        course.style.display = '';
                        visibleCount++;
                    } else {
                        course.style.display = 'none';
                    }
                });

                // Mostrar o ocultar mensaje de "No hay cursos disponibles"
                const noCoursesMessage = coursesContainer.querySelector('.no-courses-message');
                if (visibleCount === 0) {
                    noCoursesMessage.style.display = '';
                } else {
                    noCoursesMessage.style.display = 'none';
                }
            });
        });
    </script>
@endsection
