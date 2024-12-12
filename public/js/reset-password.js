$(function () {
    let f = document.getElementById("formAuthentication");

    let fv = FormValidation.formValidation(f, {
        fields: {
            password: {
                validators: {
                    notEmpty: {
                        message: "Por favor ingrese su nueva contraseña",
                    },
                    stringLength: {
                        min: 6,
                        message:
                            "La contraseña debe tener más de 6 caracteres.",
                    },
                },
            },
            "confirm-password": {
                validators: {
                    notEmpty: {
                        message: "Por favor confirme su nueva contraseña",
                    },
                    identical: {
                        compare: function () {
                            return f.querySelector('[name="password"]').value;
                        },
                        message: "Las contraseñas no coinciden",
                    },
                },
            },
        },
        plugins: {
            trigger: new FormValidation.plugins.Trigger(),
            bootstrap5: new FormValidation.plugins.Bootstrap5({
                eleValidClass: "is-valid",
                eleInvalidClass: "is-invalid",
                rowSelector: ".mb-3",
            }),
            submitButton: new FormValidation.plugins.SubmitButton(),
            autoFocus: new FormValidation.plugins.AutoFocus(),
        },
    });

    // Interceptar el envío del formulario

    fv.on("core.form.valid", function () {
        console.log("ghola");

        const submitBtn = document.querySelector(".btn-iniciosesion");

        const resetBtn = setLoadingState(submitBtn);

        const formData = new FormData(f);

        formData.append("_token", $('meta[name="csrf-token"]').attr("content"));

        $.ajax({
            url: "change", // URL de la ruta a la que estás haciendo la solicitud
            method: "POST", // Método HTTP
            data: formData, // Los datos a enviar
            processData: false, // No procesar los datos automáticamente
            contentType: false, // No establecer el tipo de contenido para que sea enviado como multipart/form-data
            success: function (data) {
                window.location.href = "/login";
            },
            error: function (xhr, status, error) {
                // Acción en caso de error
                Toast.fire({
                    icon: "error",
                    title: xhr.responseJSON
                        ? xhr.responseJSON.message
                        : "Ocurrió un error al procesar la solicitud",
                });
            },
            complete: function () {
                // Acción al finalizar la solicitud (sin importar si fue exitosa o no)
                resetBtn();
            },
        });
    });

    function setLoadingState(btnElement) {
        const originalContent = btnElement.innerHTML;
        const originalDisabled = btnElement.disabled;

        btnElement.innerHTML = "Cargando...";
        btnElement.disabled = true;

        return function resetBtn() {
            btnElement.innerHTML = originalContent;
            btnElement.disabled = originalDisabled;
        };
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
