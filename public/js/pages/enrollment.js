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
            },
        });

        $("#btnModal").on("click", function () {
            $("#shareProject").modal("show");
        });


        let csrfToken = $('meta[name="csrf-token"]').attr("content");

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
