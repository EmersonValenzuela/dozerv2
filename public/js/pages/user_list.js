"use strict";
let fv, offCanvasEl;
document.addEventListener("DOMContentLoaded", function (e) {
    console.log(course_id);
}),
    $(function () {
        var l,
            t,
            a = $(".dt-students"),
            csrf_token = $('meta[name="csrf-token"]').attr("content");

        a.length &&
            ((t = a.DataTable({
                ajax: "/user-list",
                columns: [
                    { data: "id" },
                    { data: "names" },
                    { data: "email" },
                    { data: "w_p" },
                    { data: "" },
                ],
                columnDefs: [
                    {
                        targets: 0,
                        visible: !1,
                    },
                    {
                        targets: 3,
                        className: "text-center",
                        render: function (e, t, a, s) {
                            return e;
                        },
                    },
                    {
                        targets: -1,
                        title: "Acciones",
                        orderable: !1,
                        className: "text-center",
                        render: function (e, t, a, s) {
                            return `<div class ="demo-inline-spacing">
                            <button type="button" class="btn btn-icon btn-outline-success waves-effect datatable_edit"><span class="mdi mdi-note-edit-outline"></span></button>

                             <button type="button" class="btn btn-icon btn-outline-danger waves-effect datatable_delete">
                            <span class="tf-icons mdi mdi-trash-can-outline"></span>
                            </button>
                            </div>`;
                        },
                    },
                ],
                dom: '<"table-responsive"t><"row"<"col-sm-12 col-md-6"i><"col-sm-12 col-md-6"p>>',
                order: [[1, "asc"]],
                paging: false,
                info: false,
                pageLength: -1,
                language: {
                    search: "",
                    searchPlaceholder: "Buscar Alumno",
                    sEmptyTable: "Ningún dato disponible en esta tabla",
                },
            })),
            setTimeout(() => {
                $(".dataTables_filter .form-control").removeClass(
                    "form-control-sm"
                ),
                    $(".dataTables_length .form-select").removeClass(
                        "form-select-sm"
                    );
            }, 300));

        $("#referralLink").on("keyup", function () {
            t.search(this.value).draw();
        });

        t.on("click", ".datatable_edit", function () {
            let row = $(this).closest("tr");
            let rowData = $(this).closest("table").DataTable().row(row).data();

            $("#modal_title").text("Modificar estudiante");

            $("#student_id").val(rowData.id);
            $("#names").val(rowData.names);
            $("#document").val(rowData.document);
            $("#email").val(rowData.email);
            $("#webinar").val(rowData.course);
            $("#code").val(rowData.code);

            $("#modal_student").modal("show");
        });

        t.on("click", ".datatable_delete", function () {
            let row = $(this).closest("tr");
            let rowData = $(this).closest("table").DataTable().row(row).data();

            const formData = new FormData(f);
            formData.append(
                "_token",
                $('meta[name="csrf-token"]').attr("content")
            );

            Swal.fire({
                title: "¿Estás seguro?",
                text: "¡No podrás recuperar este registro!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonText: "Si, eliminar",
                customClass: {
                    confirmButton:
                        "btn btn-primary me-3 waves-effect waves-light",
                    cancelButton: "btn btn-outline-secondary waves-effect",
                },
                buttonsStyling: false,
            }).then(function (confirm) {
                if (confirm.isConfirmed) {
                    // Aquí se hace la solicitud AJAX para eliminar el registro
                    $.ajax({
                        url: "deleteStudentWebinar/" + rowData.id, // Cambia esta URL según tu API
                        type: "POST",
                        data: formData,
                        processData: false,
                        contentType: false,
                        success: function (response) {
                            Swal.fire({
                                icon: "success",
                                title: "Eliminado!",
                                text: "El registro se eliminó con éxito.",
                                customClass: {
                                    confirmButton:
                                        "btn btn-success waves-effect",
                                },
                            });
                            t.ajax.reload();
                        },
                        error: function (error) {
                            Swal.fire({
                                icon: "error",
                                title: "Error!",
                                text: "Hubo un problema al eliminar el registro.",
                                customClass: {
                                    confirmButton:
                                        "btn btn-danger waves-effect",
                                },
                            });
                        },
                    });
                }
            });
        });

        $(".modal_add").on("click", function () {
            var table = $(".datatables_certificates").DataTable(),
                row = table.row(this).data();

            let text = $(".font-tituview").text();
            $("#webinar").val(text);
            $("#modal_title").text("Agregar estudiante");
            $("#modal_student").modal("show");
        });

        const f = document.getElementById("form_student"),
            urlMap = {
                "Agregar estudiante": "insertStudentWebinar",
                "Modificar estudiante": "updateStudentWebinar",
            };

        f.onsubmit = function (event) {
            event.preventDefault(); // Evita el envío automático del formulario

            // Seleccionar los campos requeridos
            const requiredFields = ["names", "document", "email", "webinar"];
            let formIsValid = true;
            let errorMessage = "";

            // Iterar sobre cada campo y verificar si está vacío
            requiredFields.forEach((fieldId) => {
                const field = document.getElementById(fieldId);
                if (field && field.value.trim() === "") {
                    formIsValid = false;
                    errorMessage =
                        "Por favor, complete todos los campos requeridos.";
                    field.classList.add("is-invalid"); // Agrega una clase para resaltar el campo vacío
                } else if (field) {
                    field.classList.remove("is-invalid"); // Remueve la clase si el campo está lleno
                }
            });

            if (!formIsValid) {
                // Mostrar mensaje de error general si algún campo está vacío
                Toast.fire({
                    icon: "error",
                    title: errorMessage,
                });
                return;
            }

            // Si el formulario es válido, continuar con el envío
            const action = $("#modal_title").text();
            const url = urlMap[action];

            if (url) {
                console.log("URL para enviar:", url);
                sendDataServe(url);
            }
        };

        function sendDataServe(url) {
            blockUI();

            let formData = new FormData(f);
            formData.append("_token", csrf_token);

            fetch(url, {
                method: "POST",
                body: formData,
            })
                .then((response) => {
                    if (!response.ok) {
                        throw new Error("Error en la solicitud");
                    }
                    return response.json();
                })
                .then((data) => {
                    t.ajax.reload();
                    Toast.fire({
                        icon: data.icon,
                        title: data.message,
                    });
                    f.reset();
                    fv.resetForm(true);
                })
                .catch((error) => {
                    console.error("Error:", error);
                })
                .finally(() => {
                    $.unblockUI();
                });
        }

        $("#modal_student").on("hidden.bs.modal", function () {
            f.reset();
        });

        var e,
            o = $(".datatables_certificates");
        o.length &&
            ((e = o.DataTable({
                columns: [
                    { data: "" },
                    { data: "dni" },
                    { data: "names" },
                    { data: "course" },
                    { data: "email" },
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
                        targets: 2,
                        render: function (a, t, x, s) {
                            return (
                                '<a href="javascript:void(0);"><span>' +
                                a +
                                "</span></a>"
                            );
                        },
                    },
                    {
                        targets: 3,
                        responsivePriority: 1,
                        render: function (a, t, x, s) {
                            return (
                                '<div class="d-flex flex-column"><span class="text-heading fw-medium" > ' +
                                a +
                                "</span></div></div>"
                            );
                        },
                    },
                    {
                        targets: 4,
                        responsivePriority: 2,
                        render: function (a, t, x, s) {
                            return (
                                '<div class="d-flex flex-column"><span class="text-heading fw-medium" > ' +
                                a +
                                "</span></div></div>"
                            );
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
                responsive: {
                    details: {
                        display: $.fn.dataTable.Responsive.display.modal({
                            header: function (e) {
                                return "Detalles de " + e.data().product;
                            },
                        }),
                        type: "column",
                        renderer: function (e, t, a) {
                            a = $.map(a, function (e, t) {
                                return "" !== e.title
                                    ? '<tr data-dt-row="' +
                                          e.rowIndex +
                                          '" data-dt-column="' +
                                          e.columnIndex +
                                          '"><td>' +
                                          e.title +
                                          ":</td> <td>" +
                                          e.data +
                                          "</td></tr>"
                                    : "";
                            }).join("");
                            return (
                                !!a &&
                                $('<table class="table"/><tbody />').append(a)
                            );
                        },
                    },
                },
                initComplete: function () {},
            })),
            $(".dataTables_length").addClass("mt-0 mt-md-3")),
            $(".datatables_certificates tbody").on(
                "click",
                ".delete-record",
                function () {
                    var table = $(".datatables_certificates").DataTable(); // Obtén la instancia de DataTable
                    table.row($(this).closest("tr")).remove().draw(); // Elimina la fila correspondiente
                }
            );

        $("#btnImport").on("click", function () {
            document.getElementById("excelFile").click();
        });

        $("#referralImport").on("keyup", function () {
            e.search(this.value).draw();
        });

        document
            .getElementById("excelFile")
            .addEventListener("change", function (event) {
                const file = event.target.files[0];
                const reader = new FileReader();

                reader.onload = function (i) {
                    const data = new Uint8Array(i.target.result);
                    const workbook = XLSX.read(data, { type: "array" });

                    // primera hoja
                    const firstSheetName = workbook.SheetNames[0];
                    const worksheet = workbook.Sheets[firstSheetName];

                    // Convierte la hoja de trabajo a un array de objetos JSON
                    const jsonData = XLSX.utils.sheet_to_json(worksheet, {
                        header: 1,
                    });

                    // Formato Objeto
                    const headers = jsonData[0];
                    const rows = jsonData.slice(1).map((row) => {
                        let rowData = {};
                        row.forEach((cell, index) => {
                            rowData[headers[index]] = cell;
                        });
                        return rowData;
                    });

                    rows.forEach((row) => {
                        let rowData = {
                            code: row.code,
                            dni: row.dni,
                            names: row.nombres,
                            course: row.curso,
                            score: row.nota,
                            email: row.email,
                            "": "",
                        };
                        e.row.add(rowData).draw();
                    });
                };

                reader.readAsArrayBuffer(file);
            });

        $(".btn-generate").on("click", function () {
            blockUI();

            console.log(course_id);

            const rows = e.rows().data().toArray();
            let csrfToken = $('meta[name="csrf-token"]').attr("content"),
                date = $("#date").val();

            if (rows.length === 0) {
                $.unblockUI();
                Toast.fire({
                    icon: "error",
                    title: "Debe existir al menos un registro en la tabla",
                });
                return;
            }

            if (date.length === 0) {
                $.unblockUI();
                Toast.fire({
                    icon: "error",
                    title: "Debe ingresar una fecha",
                });
                return;
            }

            let formData = new FormData();

            formData.append("id", course_id);
            formData.append("date", date);
            formData.append("rows", JSON.stringify(rows));

            formData.append("_token", csrfToken);

            $.ajax({
                url: "/Webinar/importwebinar", // Asegúrate de que coincida exactamente con la URL de la ruta
                method: "POST",
                data: formData,
                dataType: "json",
                processData: false,
                contentType: false,
            })
                .done(function (response) {
                    Toast.fire({
                        icon: response.icon,
                        title: response.message,
                    });
                    t.ajax.reload();
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

        function resetForm() {
            f.reset();
        }

        function blockUI() {
            $.blockUI({
                message:
                    '<div class="sk-wave mx-auto"><div class="sk-rect sk-wave-rect"></div> <div class="sk-rect sk-wave-rect"></div> <div class="sk-rect sk-wave-rect"></div> <div class="sk-rect sk-wave-rect"></div> <div class="sk-rect sk-wave-rect"></div></div>',
                css: { backgroundColor: "transparent", border: "0" },
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
