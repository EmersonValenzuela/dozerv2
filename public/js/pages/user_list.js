"use strict";
let fv, offCanvasEl;

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
                { data: "rol" },
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
                searchPlaceholder: "Buscar Usuario",
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

        $("#modal_title").text("Modificar usuario");

        $("#user_id").val(rowData.id);
        $("#names").val(rowData.names);
        $("#email").val(rowData.email);

        $("#modal_user").modal("show");
    });

    t.on("click", ".datatable_delete", function () {
        let row = $(this).closest("tr");
        let rowData = $(this).closest("table").DataTable().row(row).data();

        const formData = new FormData(f);
        formData.append("_token", $('meta[name="csrf-token"]').attr("content"));

        Swal.fire({
            title: "¿Estás seguro?",
            text: "¡No podrás recuperar este registro!",
            icon: "warning",
            showCancelButton: true,
            confirmButtonText: "Si, eliminar",
            customClass: {
                confirmButton: "btn btn-primary me-3 waves-effect waves-light",
                cancelButton: "btn btn-outline-secondary waves-effect",
            },
            buttonsStyling: false,
        }).then(function (confirm) {
            if (confirm.isConfirmed) {
                // Aquí se hace la solicitud AJAX para eliminar el registro
                $.ajax({
                    url: "deleteUser/" + rowData.id, // Cambia esta URL según tu API
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
                                confirmButton: "btn btn-success waves-effect",
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
                                confirmButton: "btn btn-danger waves-effect",
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
        $("#modal_title").text("Agregar usuario");
        $("#modal_user").modal("show");
    });

    const f = document.getElementById("form_student"),
        urlMap = {
            "Agregar usuario": "insertUser",
            "Modificar usuario": "updateUser",
        };

    f.onsubmit = function (event) {
        event.preventDefault(); // Evita el envío automático del formulario

        // Seleccionar los campos requeridos
        const requiredFields = ["names", "email"];
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
                $("#modal_user").modal("hide");

                Toast.fire({
                    icon: data.icon,
                    title: data.message,
                });
                f.reset();
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
