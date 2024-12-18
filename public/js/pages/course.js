"use strict";
let fv, offCanvasEl;

$(function () {
    var l,
        t,
        a = $(".dt-students"),
        csrf_token = $('meta[name="csrf-token"]').attr("content");

    a.length &&
        ((t = a.DataTable({
            ajax: course_id + "/students",
            columns: [
                { data: "names" },
                { data: "email" },
                { data: "score" },
                { data: "cm" },
                { data: "cp" },
                { data: "r_e" },
                { data: "certificate" },
                { data: "" },
            ],
            columnDefs: [
                {
                    targets: 0,
                    render: function (e, t, a, s) {
                        return `<div class="d-flex justify-content-start align-items-center user-name text-white"><div class="avatar-wrapper me-3"></div><div class="d-flex flex-column"><span class="text-heading fw-medium">${a.code}</span><small class="text-truncate">${e}</small></div></div>`;
                    },
                },
                {
                    targets: 2,
                    className: "text-center",
                    render: function (data, type, row) {
                        if (type === "display") {
                            return `
                                <input 
                                    type="number" 
                                    class="editable-score" 
                                    data-id="${row.id}" 
                                    value="${data}" 
                                    min="0" 
                                    max="20" 
                                    style="width: 100%; text-align: center;"
                                />
                            `;
                        }
                        return data;
                    },
                },
                {
                    targets: 3,
                    className: "text-center",
                    render: function (e, t, a, s) {
                        if (e) {
                            return `<a href="${enrollmentUrl}/matricula_${a.code}.pdf" download class= "btn btn-icon   btn-danger">
                                            <span class="mdi mdi-file-pdf-box text-white size-icon"></span>
                                        </a> <button type="button" class="btn btn-icon btn-outline-success waves-effect datatable_edit" data-certificate="c_m" data-name="Constancia de Matricula" data-date="Fecha"><span class="mdi mdi-note-edit-outline"></span></button>`;
                        } else {
                            return ` <button type="button" class="btn btn-icon btn-outline-success waves-effect datatable_edit" data-certificate="c_m" data-name="Constancia de Matricula" data-date="Fecha"><span class="mdi mdi-note-edit-outline"></span></button>`;
                        }
                    },
                },
                {
                    targets: 4,
                    className: "text-center",
                    render: function (e, t, a, s) {
                        if (e) {
                            return `<a href="${constancyUrl}/constancia_participacion_${a.code}.pdf" download class= "btn btn-icon   btn-danger">
                                            <span class="mdi mdi-file-pdf-box text-white size-icon"></span>
                                        </a>  <button type="button" class="btn btn-icon btn-outline-success waves-effect datatable_edit" data-certificate="c_p" data-name="Constancia de Participación" data-date="Descripción"><span class="mdi mdi-note-edit-outline"></span></button>`;
                        } else {
                            return `<button type="button" class="btn btn-icon btn-outline-success waves-effect datatable_edit" data-certificate="c_p" data-name="Constancia de Participación" data-date="Descripción"><span class="mdi mdi-note-edit-outline" ></span></button>`;
                        }
                    },
                },
                {
                    targets: 5,
                    className: "text-center",
                    render: function (e, t, a, s) {
                        if (e) {
                            return `<a href="${recognitionUrl}/excelencia_${a.code}.pdf" download class= "btn btn-icon btn-danger">
                                            <span class="mdi mdi-file-pdf-box text-white size-icon"></span>
                                        </a>   <button type="button" class="btn btn-icon btn-outline-success waves-effect datatable_edit" data-certificate="r_e" data-name="Reconocimiento a la Excelencia" data-date="Fecha"><span class="mdi mdi-note-edit-outline"></span></button>`;
                        } else {
                            return ` <button type="button" class="btn btn-icon btn-outline-success waves-effect datatable_edit" data-certificate="r_e" data-name="Reconocimiento a la Excelencia" data-date="Fecha"><span class="mdi mdi-note-edit-outline"></span></button>`;
                        }
                    },
                },
                {
                    targets: 6,
                    className: "text-center",
                    render: function (e, t, a, s) {
                        if (e) {
                            return `<a href="${certificateUrl}/certificado_${a.code}.pdf" download class= "btn btn-icon btn-danger">
                                            <span class="mdi mdi-file-pdf-box text-white size-icon"></span>
                                        </a> 
                                <button type="button" class="btn btn-icon btn-outline-success waves-effect datatable_edit" data-certificate="m" data-name="Certificado de Matrícula" data-date="Sin descripción"><span class="mdi mdi-note-edit-outline"></span></button>
                                `;
                        } else {
                            return ` <button type="button" class="btn btn-icon btn-outline-success waves-effect datatable_edit" data-certificate="m" data-name="Certificado de Matrícula" data-date="Sin descripción"><span class="mdi mdi-note-edit-outline"></span></button>`;
                        }
                    },
                },
                {
                    targets: -1,
                    title: "Acciones",
                    orderable: !1,
                    className: "text-center",
                    render: function (e, t, a, s) {
                        let uploadButton = "";

                        // Verificar si mapCertificate es "CIP" o "CAP"
                        if (
                            mapCertificate === "CIP" ||
                            mapCertificate === "CAP"
                        ) {
                            uploadButton = `
                                <button type="button" class="btn btn-icon btn-outline-info waves-effect datatable_upload">
                                    <span class="tf-icons mdi mdi-upload"></span>
                                </button>
                                <input type="file" class="upload-input" id="certificado_${a.code}" accept="application/pdf" style="display: none;">
                            `;
                        }

                        return `<button type="button" class="btn btn-icon btn-outline-warning waves-effect datatable_delete">
                                    <span class="tf-icons mdi mdi-reload-alert"></span>
                                </button> ${uploadButton}`;
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

    t.on("change", ".editable-score", function () {
        var score = $(this).val();
        var studentId = $(this).data("id");

        // Validar entrada: debe estar entre 0 y 20
        if (isNaN(score) || score < 0 || score > 20) {
            Toast.fire({
                icon: "error",
                title: "Entrada no válida",
            });
            $(this).val(Math.max(0, Math.min(score, 20))); // Restaurar dentro del rango permitido
            return;
        }

        // 3. Enviar la actualización vía AJAX
        $.ajax({
            url: `/students/${studentId}/update-score`,
            method: "POST",
            data: {
                score: score,
                _token: $('meta[name="csrf-token"]').attr("content"), // CSRF token
            },
            success: function (response) {
                if (response.success) {
                    Toast.fire({
                        icon: "success",
                        title: "Actualizado",
                    });

                    table.ajax.reload(null, false); // Recargar tabla sin reiniciar la paginación
                } else {
                    alert("Hubo un error al actualizar el puntaje.");
                }
            },
            error: function () {
                alert("Error al conectar con el servidor.");
            },
        });
    });

    $("#btnModalAdd").on("click", function () {
        $("#modal_title").text("Agregar estudiante");
        $("#modal_student").modal("show");
        $("#certificate").val("add");
        $("#score").val("0");
        $("#course_name").val($(".font-tituview").text());
        $("#course_id").val(course_id);
        $("#label-date").html("Sin descripción: ");
    });

    const images = {
        c_m: { imgUrl: img1cm },
        c_p: { imgUrl: imgcp },
        r_e: { imgUrl: imgre },
        m: { imgUrl: img1, imgUrl2: img2 },
    };

    t.on("click", ".datatable_edit", function () {
        let row = $(this).closest("tr");
        let rowData = $(this).closest("table").DataTable().row(row).data();
        let certificate = $(this).data("certificate"),
            subtitle = $(this).data("name"),
            date = $(this).data("date");

        if (images[certificate]) {
            $("#imgUrl").val(images[certificate].imgUrl || "");
            $("#imgUrl2").val(images[certificate].imgUrl2 || "");
        }

        $("#modal_title").text("Modificar estudiante");

        $("#label-date").html(date);
        $("#modal_subtitle").text(subtitle);
        $("#course_id").val(course_id);
        $("#certificate").val(certificate);
        $("#code").val(rowData.code);
        $("#student_id").val(rowData.id);
        $("#names").val(rowData.names);
        $("#document").val(rowData.document);
        $("#email").val(rowData.email);
        $("#score").val(rowData.score);
        $("#course_name").val(rowData.course);
        $("#code").val(rowData.code);

        $("#modal_student").modal("show");
    });

    t.on("click", ".datatable_delete", function () {
        let row = $(this).closest("tr");
        let rowData = $(this).closest("table").DataTable().row(row).data();

        $("#modal_delete").modal("show");
        $("#codeDelete").val(rowData.code);
        $("#idDelete").val(rowData.id);
        $("#studentDelete").val(rowData.names);
    });

    t.on("click", ".datatable_upload", function () {
        console.log("Botón subir presionado");
        const id = $(this).next(".upload-input").attr("id"); // Busca el input asociado al botón
        console.log(id);

        if (id) {
            $(`#${id}`).click(); // Simula el clic en el input
        }
    });

    t.on("change", ".upload-input", function () {
        blockUI();
        const file = this.files[0];
        const id = $(this).attr("id"); // Extraer el ID de la estructura "upload_ID"

        if (file && id) {
            console.log("Archivo seleccionado:", file.name);
            console.log("ID asociado:", id);

            // Crear el FormData para enviar los datos
            const formData = new FormData();
            formData.append("file", file);
            formData.append("id", id);
            formData.append("_token", csrf_token);

            // Enviar los datos al servidor
            uploadFile(formData);
        } else {
            console.warn("No se seleccionó un archivo o no se encontró el ID.");
        }
    });

    function uploadFile(formData) {
        $.ajax({
            url: "uploadFile", // Cambia por tu ruta al backend
            type: "POST",
            data: formData,
            processData: false, // Evitar que jQuery procese el FormData
            contentType: false, // Evitar que jQuery establezca el tipo de contenido
            success: function (response) {
                // Mostrar el mensaje basado en la respuesta del servidor
                Toast.fire({
                    icon: response.icon, // Usamos el icono dinámico de la respuesta
                    title: response.message, // Usamos el mensaje dinámico de la respuesta
                });
                $.unblockUI();
            },
            error: function (xhr, status, error) {
                // Mostrar un mensaje de error en caso de fallo
                Toast.fire({
                    icon: "error",
                    title: "Error al subir el archivo",
                });
            },
        });
    }

    $("#btnDelete").on("click", function () {
        let certificate = $("#deleteType").val(),
            route = $("#deleteType option:selected").data("route"),
            prefix = $("#deleteType option:selected").data("prefix"),
            id = $("#idDelete").val(),
            code = $("#codeDelete").val();

        $.ajax({
            url: "/StudentCourse/delete",
            type: "POST",
            data: {
                certificate: certificate,
                prefix: prefix,
                code: code,
                id: id,
                route: route,
                _token: $('meta[name="csrf-token"]').attr("content"),
            },
            success: function (data) {
                $("#modal_delete").modal("hide");
                t.ajax.reload();
                console.log(data);

                Toast.fire({
                    icon: data.icon,
                    title: data.message,
                });
            },
        });
    });

    const f = document.getElementById("form_student"),
        urlMap = {
            add: "addStudent",
            edit: "updateStudent",
            c_m: "cmStudent",
            c_p: "cpStudent",
            r_e: "reStudent",
            m: "mStudent",
        };

    f.onsubmit = function (event) {
        event.preventDefault();

        const requiredFields = [
            "names",
            "document",
            "email",
            "score",
            "course_name",
            "course_date",
        ];

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
        const action = $("#certificate").val();
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

        fetch(baseUrl + "/" + url, {
            method: "POST",
            body: formData,
        })
            .then((response) => {
                if (!response.ok) {
                    Toast.fire({
                        icon: response.icon,
                        title: response.message,
                    });
                }
                return response.json();
            })
            .then((data) => {
                t.ajax.reload();
                Toast.fire({
                    icon: data.icon,
                    title: data.message,
                });
                resetForm();
            })
            .catch((error) => {
                Toast.fire({
                    icon: error.icon,
                    title: error.message,
                });
            })
            .finally(() => {
                $.unblockUI();
            });
    }

    $("#modal_student").on("hidden.bs.modal", function () {
        f.reset();
    });

    function resetForm() {
        f.reset();
    }

    var e,
        o = $(".datatables_add");
    o.length &&
        ((e = o.DataTable({
            columns: [
                { data: "code" },
                { data: "code" },
                { data: "dni" },
                { data: "names" },
                { data: "score" },
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
                            '<a href="app-ecommerce-order-details.html"><span>' +
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
        $(".datatables_add tbody").on("click", ".delete-record", function () {
            var table = $(".datatables_add").DataTable(); // Obtén la instancia de DataTable
            table.row($(this).closest("tr")).remove().draw(); // Elimina la fila correspondiente
        });

    $("#btnImport").on("click", function () {
        document.getElementById("excelFile").click();
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
        let csrfToken = $('meta[name="csrf-token"]').attr("content");

        if (rows.length === 0) {
            $.unblockUI();
            Toast.fire({
                icon: "error",
                title: "Debe existir al menos un registro en la tabla",
            });
            return;
        }

        let formData = new FormData();

        formData.append("id", course_id);
        formData.append("rows", JSON.stringify(rows));

        formData.append("_token", csrfToken);

        $.ajax({
            url: "/Certificate/import", // Asegúrate de que coincida exactamente con la URL de la ruta
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

    function updateCourse(element) {
        const id = element.getAttribute("data-id");
        const field = element.getAttribute("data-field");
        const value = element.innerText;

        console.log(id, field, value);
    }
});
