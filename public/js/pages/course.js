"use strict";
let fv, offCanvasEl;
document.addEventListener("DOMContentLoaded", function (e) {
    console.log(course_id);
}),
    $(function () {
        var l,
            t,
            a = $(".dt-students");

        a.length &&
            ((t = a.DataTable({
                ajax: course_id + "/students",
                columns: [
                    { data: "names" },
                    { data: "email" },
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
                        render: function (e, t, a, s) {
                            if (e) {
                                return `<button type="button" class="btn btn-icon btn-danger"><span class="mdi mdi-file-pdf-box text-white size-icon"></span></button>`;
                            } else {
                                return `<button type="button" class="btn btn-icon btn-info"><span class="mdi mdi-file-sign text-white size-icon"></span></button>`;
                            }
                        },
                    },
                    {
                        targets: 3,
                        className: "text-center",
                        render: function (e, t, a, s) {
                            if (e) {
                                return `<button type="button" class="btn btn-icon btn-danger"><span class="mdi mdi-file-pdf-box text-white size-icon"></span></button>`;
                            } else {
                                return `<button type="button" class="btn btn-icon btn-info"><span class="mdi mdi-file-sign text-white size-icon"></span></button>`;
                            }
                        },
                    },
                    {
                        targets: 4,
                        className: "text-center",
                        render: function (e, t, a, s) {
                            if (e) {
                                return `<button type="button" class="btn btn-icon btn-danger"><span class="mdi mdi-file-pdf-box text-white size-icon"></span></button>`;
                            } else {
                                return ` <button type="button" class="btn btn-icon btn-info"><span class="mdi mdi-file-sign text-white size-icon"></span></button>`;
                            }
                        },
                    },
                    {
                        targets: 5,
                        className: "text-center",
                        render: function (e, t, a, s) {
                            if (e) {
                                return `<button type="button" class="btn btn-icon btn-danger"><span class="mdi mdi-file-pdf-box text-white size-icon"></span></button>`;
                            } else {
                                return ` <button type="button" class="btn btn-icon btn-info"><span class="mdi mdi-file-sign text-white size-icon"></span></button>`;
                            }
                        },
                    },
                    {
                        targets: -1,
                        title: "Acciones",
                        orderable: !1,
                        className: "text-center",
                        render: function (e, t, a, s) {
                            return `<button type="button" class="btn btn-icon btn-secondary"><span class="mdi mdi-email-arrow-right"></span></button>`;
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

        var e,
            o = $(".datatables_add");
        o.length &&
            ((e = o.DataTable({
                columns: [
                    { data: "code" },
                    { data: "code" },
                    { data: "dni" },
                    { data: "names" },
                    { data: "course" },
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
            $(".datatables_add tbody").on(
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
    });
