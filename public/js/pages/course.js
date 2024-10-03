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
                    { data: "w_p" },
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
                        targets: 6,
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
    });
