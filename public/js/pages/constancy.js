"use strict";
!(function () {
    let e = document.getElementById("uploadedAvatar");
    const l = document.querySelector(".account-file-input");
    if (e) {
        const r = e.src;
        l.onchange = () => {
            l.files[0] && (e.src = window.URL.createObjectURL(l.files[0]));
        };
    }
})(),
    $(function () {
        let csrfToken = $('meta[name="csrf-token"]').attr("content");

        var e = $(".selectpicker"),
            t = $(".select2"),
            c = $(".select2-icons");
        function l(e) {
            return e.id
                ? "<i class='" +
                      $(e.element).data("icon") +
                      " me-2'></i>" +
                      e.text
                : e.text;
        }
        e.length && (e.selectpicker(), handleBootstrapSelectEvents()),
            t.length &&
                t.each(function () {
                    var e = $(this);
                    select2Focus(e),
                        e
                            .wrap('<div class="position-relative"></div>')
                            .select2({
                                placeholder: "Select value",
                                dropdownParent: e.parent(),
                                maximumSelectionLength: 15, // Límite de selección
                                language: {
                                    searching: function () {
                                        return "Buscando...";
                                    },
                                    noResults: function () {
                                        return "No se encontraron resultados";
                                    },
                                    inputTooShort: function () {
                                        return "Por favor, ingresa 2 o más caracteres";
                                    },
                                    maximumSelected: function () {
                                        return "Solo puedes seleccionar hasta 12 estudiantes.";
                                    },
                                },
                            });
                }),
            c.length &&
                (select2Focus(c),
                c.wrap('<div class="position-relative"></div>').select2({
                    dropdownParent: c.parent(),
                    templateResult: l,
                    templateSelection: l,
                    escapeMarkup: function (e) {
                        return e;
                    },
                }));
        let studentData = [];
        var d,
            o = $(".datatables_enrollment");
        o.length &&
            ((d = o.DataTable({
                columns: [
                    { data: "id" },
                    { data: "code" },
                    { data: "names" },
                    { data: "course" },
                    { data: " " },
                ],
                columnDefs: [
                    {
                        className: "control",
                        searchable: !1,
                        orderable: !1,
                        responsivePriority: 2,
                        targets: 0,
                        visible: 0,
                        render: function (a, t, x, s) {
                            return "";
                        },
                    },

                    {
                        targets: -1,
                        title: "Acciones",
                        searchable: !1,
                        orderable: !1,
                        className: "text-center",
                        render: function (e, t, a, s) {
                            return '<div class="align-items-center"><a href="javascript:;" data-bs-toggle="tooltip" class="text-body delete-record" data-bs-placement="top" aria-label="Delete Invoice" data-bs-original-title="Delete Invoice"><i class="mdi mdi-delete-outline mdi-20px mx-1"></i></a></div></div>';
                        },
                    },
                ],
                order: [[1, "asc"]],
                dom: '<"card-header d-flex align-items-md-center flex-wrap"<"dt-action-buttons text-xl-end text-lg-start text-md-end text-start d-flex align-items-end align-items-md-center justify-content-md-end pt-0 gap-3 flex-wrap"l<"review_filter">>>t<"row mx-2"<"col-sm-12 col-md-6"i><"col-sm-12 col-md-6"p>>',

                pageLength: -1,
                lengthChange: false,
                language: {
                    search: "",
                    searchPlaceholder: "Buscar Alumno",
                    sEmptyTable: "Ningún dato disponible en esta tabla",
                },

                initComplete: function () {},
            })),
            $(".dataTables_length").addClass("mt-0 mt-md-3")),
            $(".datatables_enrollment tbody").on(
                "click",
                ".delete-record",
                function () {
                    var table = $(".datatables_enrollment").DataTable();
                    table.row($(this).closest("tr")).remove().draw();
                }
            );
        setTimeout(() => {
            $(".dataTables_filter .form-control").removeClass(
                "form-control-sm"
            ),
                $(".dataTables_length .form-select").removeClass(
                    "form-select-sm"
                );
        }, 300);

        $("#course").select2({
            dropdownParent: $("#dataConstancy"),
            ajax: {
                url: "/scopeCoruse",
                dataType: "json",
                delay: 250,
                data: function (params) {
                    return {
                        query: params.term,
                    };
                },
                processResults: function (data) {
                    return {
                        results: $.map(data, function (row) {
                            return {
                                id: row.id_course,
                                text:
                                    row.code_course +
                                    " - " +
                                    row.course_or_event,
                            };
                        }),
                    };
                },
                cache: true,
            },
            placeholder: "BUSCA UNA CAPACITACIÓN (Nombre o Código)",
            minimumInputLength: 2,
            language: {
                searching: function () {
                    return "Buscando...";
                },
                noResults: function () {
                    return "No se encontraron resultados";
                },
                inputTooShort: function () {
                    return "Por favor, ingresa 2 o más caracteres";
                },
                maximumSelected: function () {
                    return "Solo puedes seleccionar hasta 3 opciones.";
                },
            },
        });

        $("#course").on("change", function () {
            const courseId = $(this).val();

            fetch("/scopeStudentConstancy", {
                method: "POST",
                headers: {
                    "Content-Type": "application/json",
                    "X-CSRF-TOKEN": csrfToken, // Asegúrate de que csrfToken esté definido
                },
                body: JSON.stringify({
                    course: courseId,
                }),
            })
                .then((response) => response.json())
                .then((data) => {
                    studentData = data; // Almacena la lista de estudiantes en studentData
                    $("#select2Multiple").empty();

                    data.forEach((student) => {
                        const option = new Option(
                            `${student.full_name} - ${student.code}`,
                            student.id_student
                        );

                        $(option).attr("data-course", student.course_or_event);
                        $(option).attr("data-code", student.code);

                        $("#select2Multiple").append(option);
                    });

                    $("#select2Multiple").trigger("change");
                })
                .catch((error) => {
                    console.error("Error fetching data:", error);
                });
        });
        $("#addStudents").on("click", function () {
            const selectedOptions = $("#select2Multiple").val();

            selectedOptions.forEach((id) => {
                const student = studentData.find(
                    (s) => s.id_student === Number(id)
                );

                if (student) {
                    // Verificar si el estudiante ya está en la tabla
                    const isStudentAdded = d
                        .rows()
                        .data()
                        .toArray()
                        .some((row) => row.id === student.id_student);

                    if (!isStudentAdded) {
                        d.row
                            .add({
                                id: student.id_student,
                                code: student.code,
                                names: student.full_name,
                                course: student.course_or_event,
                                actions:
                                    '<button class="removeStudent">Eliminar</button>',
                            })
                            .draw();
                    }
                }
            });

            $("#shareProject").modal("hide");
        });

        $("#btnModal").on("click", function () {
            $("#shareProject").modal("show");
        });

        $(".btn-generate").on("click", function () {
            blockUI();
            const rows = d.rows().data().toArray(); // Obtiene todos los registros del DataTable
            const ids = rows.map((row) => row.id);
            let date = $("#date").val();

            if (!date.trim()) {
                $.unblockUI();
                Toast.fire({
                    icon: "error",
                    title: "Debes ingresar una fecha para el grupo de constancias",
                });
                return;
            }

            if (rows.length === 0) {
                $.unblockUI();
                Toast.fire({
                    icon: "error",
                    title: "Debe existir al menos un registro en la tabla",
                });
                return;
            }

            let formData = new FormData();

            formData.append("file1", $("#upload")[0].files[0]);
            formData.append("date", date);
            formData.append("course", $("#course").val());
            formData.append("rows", JSON.stringify(ids));

            formData.append("_token", csrfToken);

            $.ajax({
                url: "generateConstancy",
                method: "POST",
                data: formData,
                dataType: "json",
                processData: false,
                contentType: false,
            })
                .done(function (response) {
                    console.log(response);

                    Toast.fire({
                        icon: response.icon,
                        title: response.message,
                    });
                })
                .fail(function (xhr, status, error) {
                    Toast.fire({
                        icon: error.icon,
                        title: error.message,
                    });
                    console.error(xhr.responseText);
                })
                .always(function () {
                    $.unblockUI();
                });
        });

        function blockUI() {
            $.blockUI({
                message:
                    '<div class="d-flex justify-content-center"><p class="mt-1">CARGANDO &nbsp; </p> <div class="sk-wave m-0"><div class="sk-rect sk-wave-rect"></div> <div class="sk-rect sk-wave-rect"></div> <div class="sk-rect sk-wave-rect"></div> <div class="sk-rect sk-wave-rect"></div> <div class="sk-rect sk-wave-rect"></div></div> </div>',
                css: {
                    backgroundColor: "transparent",
                    color: "#fff",
                    border: "0",
                },
                overlayCSS: { opacity: 0.5 },
            });
        }

        const Toast = Swal.mixin({
            toast: true,
            position: "top-end",
            showConfirmButton: false,
            timer: 3000,
            timerProgressBar: true,
            didOpen: (toast) => {
                toast.onmouseenter = Swal.stopTimer;
                toast.onmouseleave = Swal.resumeTimer;
            },
        });
    });
