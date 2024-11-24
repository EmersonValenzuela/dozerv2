"use strict";
$(function () {
    let h,
        a,
        s,
        csrfToken = $('meta[name="csrf-token"]').attr("content");
    s = (
        isDarkStyle
            ? ((h = config.colors_dark.borderColor),
              (a = config.colors_dark.bodyBg),
              config.colors_dark)
            : ((h = config.colors.borderColor),
              (a = config.colors.bodyBg),
              config.colors)
    ).headingColor;
    var z = $(".select2"),
        z =
            z.length &&
            z.each(function () {
                var z = $(this);
                select2Focus(z),
                    z.wrap('<div class="position-relative"></div>').select2({
                        dropdownParent: z.parent(),
                        placeholder: z.data("placeholder"),
                    });
            });
    var e;
    var o = $(".datatables_certificates");
    o.length &&
        ((e = o.DataTable({
            columns: [
                { data: "id" },
                { data: "id" },
                { data: "dni" },
                { data: "names" },
                { data: "email" },
                { data: "code" },
                { data: " " },
            ],

            columnDefs: [
                {
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
                    targets: 1, // Ajusta el índice de la columna donde están los checkboxes
                    orderable: false,
                    checkboxes: !0,
                    checkboxes: {
                        selectRow: true,
                        selectAllRender:
                            '<div class="form-check form-check-primary"><input type="checkbox" class="dt-checkboxes form-check-input"></div>',
                    },
                    render: function () {
                        return '<div class="form-check form-check-warning"><input type="checkbox" class="dt-checkboxes form-check-input"></div>';
                    },
                },

                {
                    targets: 2,
                    render: function (a, t, x, s) {
                        return (
                            '<a href="javascript:void(0);" class="text-warning"><span>' +
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
                            '<div class="d-flex flex-column"><span class="fw-medium text-white" > ' +
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
                            '<div class="d-flex flex-column"><span class="fw-medium text-white" > ' +
                            a +
                            "</span></div></div>"
                        );
                    },
                },
                {
                    targets: -2,
                    visible: false,
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
            select: {
                style: "multi", // Permite selección múltiple
            },
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
    setTimeout(() => {
        $(".dataTables_filter .form-control").removeClass("form-control-sm"),
            $(".dataTables_length .form-select").removeClass("form-select-sm");
    }, 300);

    $("#type_txt").on("change", function () {
        blockUI();
        $.ajax({
            url: "get-programs/" + this.value,
            method: "GET",
            dataType: "json",
        })
            .done(function (response) {
                $("#program_txt").empty();
                $("#program_txt").append(
                    `<option value="">Selecciona programa</option>`
                );
                $("#course_txt").empty();
                $("#course_txt").append(
                    `<option value="">Selecciona Curso</option>`
                );

                response.forEach((program) => {
                    $("#program_txt").append(
                        '<option value="' +
                            program.id_program_type +
                            '">' +
                            program.program_type.name +
                            "</option>"
                    );
                });
            })
            .fail(function (xhr, status, error) {
                console.error(xhr.responseText);
            })
            .always(() => {
                $.unblockUI();
            });
    });

    $("#program_txt").on("change", function () {
        blockUI();
        $.ajax({
            url: "get-courses/" + $("#type_txt").val() + "/" + this.value,
            method: "GET",
            dataType: "json",
        })
            .done(function (response) {
                $("#course_txt").empty();
                $("#course_txt").append(
                    `<option value="">Selecciona Curso</option>`
                );
                response.forEach((course) => {
                    $("#course_txt").append(
                        '<option value="' +
                            course.id_course +
                            '">' +
                            course.course_or_event +
                            "</option>"
                    );
                });
            })
            .fail(function (xhr, status, error) {
                console.error(xhr.responseText);
            })
            .always(() => {
                $.unblockUI();
            });
    });

    $("#referralLink").on("keyup", function () {
        e.search(this.value).draw();
    });

    const f = document.getElementById("filterMails");

    $("#filterMails").on("submit", function (g) {
        g.preventDefault();

        blockUI();

        const csrfToken = $('meta[name="csrf-token"]').attr("content");

        let formData = new FormData(f);

        formData.append("_token", csrfToken);

        let cert = $("#type_txt").val();
        let program = $("#program_txt").val();
        let certTxt = $("#certificate_txt").val();
        console.log(cert, program, certTxt);
        

        $.ajax({
            url: "/get-students-mails",
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
                e.clear().rows.add(response.data).draw();
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

    $("#send_mails").on("click", function () {
        // Obtener las filas seleccionadas
        let selectedRecords = e.rows({ selected: true }).data().toArray();
        let cert = $("#type_txt").val();
        let program = $("#program_txt").val();
        let certTxt = $("#certificate_txt").val();
        // Verifica si hay registros seleccionados
        if (selectedRecords.length > 0) {
            // Preparar los datos para enviar al backend
            let recordsToSend = selectedRecords.map((record) => ({
                id: record.id,
                code: record.code,
                names: record.names,
                email: record.email,
            }));

            console.log(recordsToSend);

            $.ajax({
                url: "sendMails",
                method: "POST",
                data: {
                    certificado: cert,
                    programa: program,
                    certificadoTxt: certTxt,
                    _token: csrfToken, // Token CSRF para Laravel
                    records: recordsToSend,
                },
                dataType: "json",
            })
                .done(function (response) {
                    console.log(response);
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
        } else {
            alert("Por favor selecciona al menos un registro.");
        }
    });

    $(".btn-generate").on("click", function () {
        blockUI();
        const rows = e.rows().data().toArray();
        let name = $("#title").val(),
            csrfToken = $('meta[name="csrf-token"]').attr("content"),
            date = $("#date").val();

        let formData = new FormData();

        formData.append("file1", $("#upload")[0].files[0]);
        formData.append("name", name);
        formData.append("date", date);
        formData.append("rows", JSON.stringify(rows));

        formData.append("_token", csrfToken);

        $.ajax({
            url: "insertWebinar",
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

                Swal.fire({
                    title: "<strong>Webinar Creado</strong>",
                    icon: "success",
                    html: "Puedes ir al curso para generar los PDFs y enviar correos",
                    showCloseButton: true,
                    showCancelButton: true,
                    focusConfirm: false,
                    confirmButtonText:
                        '<i class="mdi mdi mdi-page-next me-2"></i> Ir al webinar',
                    cancelButtonText:
                        "<i class='mdi mdi mdi-plus-box me-2'></i> Seguir Aqui",
                    customClass: {
                        confirmButton:
                            "btn btn-primary me-3 waves-effect waves-light",
                        cancelButton: "btn btn-outline-warning waves-effect",
                    },
                    buttonsStyling: false,
                    allowOutsideClick: false, // Evita que el modal se cierre al hacer clic fuera de él
                    allowEscapeKey: false, // Evita que el modal se cierre al presionar la tecla Escape
                    preConfirm: () => {
                        window.location.href = "Webinar/" + response.course;
                    },
                }).then((result) => {
                    if (result.dismiss === Swal.DismissReason.cancel) {
                        location.reload();
                    }
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
