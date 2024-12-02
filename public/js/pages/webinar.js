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

    let a = document.getElementById("uploadedAvatar2");
    const b = document.querySelector(".account-file-input2");
    if (a) {
        const f = a.src;
        b.onchange = () => {
            b.files[0] && (a.src = window.URL.createObjectURL(b.files[0]));
        };
    }
})(),
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
        var e,
            o = $(".datatables_certificates");
        o.length &&
            ((e = o.DataTable({
                columns: [
                    { data: "" },
                    { data: "dni" },
                    { data: "names" },
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
        setTimeout(() => {
            $(".dataTables_filter .form-control").removeClass(
                "form-control-sm"
            ),
                $(".dataTables_length .form-select").removeClass(
                    "form-select-sm"
                );
        }, 300);
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
                            dni: row.dni,
                            names: row.nombres,
                            email: row.email,
                            "": "",
                        };
                        e.row.add(rowData).draw();
                    });
                };

                reader.readAsArrayBuffer(file);
            });

        $("#referralLink").on("keyup", function () {
            e.search(this.value).draw();
        });

        $(".btn-generate").on("click", function () {
            blockUI();
            const rows = e.rows().data().toArray();
            let name = $("#title").val(),
                csrfToken = $('meta[name="csrf-token"]').attr("content"),
                date = $("#date").val();

            if (!name.trim()) {
                $.unblockUI();
                Toast.fire({
                    icon: "error",
                    title: "Debes ingresar un nombre para el webinar",
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

            if (date.length === 0) {
                $.unblockUI();
                Toast.fire({
                    icon: "error",
                    title: "Debe ingresar una fecha",
                });
                return;
            }

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
                    console.log(response);

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
                            cancelButton:
                                "btn btn-outline-warning waves-effect",
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
