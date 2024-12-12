$(function () {
    let f = document.getElementById("formAuthentication");
    let fv = FormValidation.formValidation(f, {
        fields: {
            email: {
                validators: {
                    notEmpty: {
                        message: "Por favor ingrese su correo electrónico",
                    },
                    emailAddress: {
                        message:
                            "Por favor ingrese una dirección de correo electrónico válida",
                    },
                },
            },
            password: {
                validators: {
                    notEmpty: {
                        message: "Por favor ingrese su contraseña",
                    },
                    stringLength: {
                        min: 6,
                        message:
                            "La contraseña debe tener más de 6 caracteres.",
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
        const submitBtn = document.querySelector(".btn-iniciosesion");

        const resetBtn = setLoadingState(submitBtn);

        const formData = new FormData(f);

        formData.append("_token", $('meta[name="csrf-token"]').attr("content"));

        fetch("auth-user", {
            method: "POST",
            body: formData,
        })
            .then((response) => {
                if (!response.ok) {
                    throw new Error(
                        "Hubo un problema al procesar el formulario."
                    );
                }
                return response.json();
            })
            .then((data) => {
                if (data.status === 200) {
                    Toast.fire({
                        icon: "success",
                        title: data.message,
                    });
                    closeForm();
                    $("#addPermissionModal").modal("hide");
                } else {
                    Toast.fire({
                        icon: "error",
                        title: data.message,
                    });
                }
            })
            .catch((error) => {
                console.error("Error:", error.message);
                Toast.fire({
                    icon: "error",
                    title: error.message,
                });
            })
            .finally(() => {
                resetBtn();
            });
    });

    function setLoadingState(btnElement) {
        const originalContent = btnElement.innerHTML;
        const originalDisabled = btnElement.disabled;

        btnElement.innerHTML =
            '<span class="spinner-border me-1" role="status" aria-hidden="true"></span>Cargando...';
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
