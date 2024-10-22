import { default as axios } from "axios";
import Swal from "sweetalert2";
import {
    desplegar_validation_error,
    limpiar_validation_error,
} from "../../../../utils/validation-error";

export default async function save_edit(e) {
    e.preventDefault();

    const url = this.dataset.url;
    const parent = this.closest("tr");
    const inputs = parent.querySelectorAll("input");
    const formData = new FormData();

    try {
        inputs.forEach((el) => {
            const type = el.getAttribute("type");

            if (type == "file") {
                formData.append(el.getAttribute("name"), el.files[0]);
            } else if (type == "checkbox") {
                formData.append(el.getAttribute("name"), el.checked);
            } else {
                formData.append(el.getAttribute("name"), el.value);
            }
        });
    } catch (error) {
        console.log(error);
    }

    // Mandar por ajax lo que esta en el input
    await axios
        .post(url, formData, {
            headers: {
                "Content-Type": "multipart/form-data",
            },
        })
        .then((resp) => {

            try {

                limpiar_validation_error();

                Swal.fire({
                    icon: "success",
                    title: resp.data.title,
                    text: resp.data.message,
                    confirmButtonColor: "#3085d6",
                });

                inputs.forEach((el) => {
                    const type = el.getAttribute("type");

                    if (type == "file") {
                        const anchor = el.parentElement.querySelector(".enlace-img");
                        anchor.href = resp.data.data.url;

                        const span = anchor.querySelector("span");
                        span.textContent = resp.data.data.archivo;
                    } else if (type == "checkbox") {
                        const span = el.parentElement.querySelector("span");
                        const input = el.parentElement.querySelector("input");

                        span.removeAttribute("class");
                        if (input.checked) {
                            span.textContent = "Sí";
                            span.classList.add("text-green-500", "font-bold");
                        } else {
                            span.textContent = "No";
                            span.classList.add("text-red-500", "font-bold");
                        }
                    } else {
                        const span = el.parentElement.querySelector("span");
                        const input = el.parentElement.querySelector("input");
                        if(span) {
                            span.textContent = input.value.toUpperCase();
                        }
                    }
                });

                parent.querySelector(".cancel-btn").click();

            } catch (error) {
                console.log(error);
            }

        })
        .catch((err) => {

            if(err.response.status == 400) {
                desplegar_validation_error(parent, err.response);
            } else if (err.response.status == 404) {
                Swal.fire({
                    icon: "error",
                    title: "Error 404",
                    text: "El recurso solicitado no ha sido encontrado.",
                    confirmButtonColor: "#3085d6",
                });
            } else if (err.response.status == 500) {
                Swal.fire({
                    icon: "error",
                    title: "Error 500",
                    text: "Hubo un problema al procesar su solicitud.",
                    confirmButtonColor: "#3085d6",
                });
            } else {
                Swal.fire({
                    icon: "error",
                    title: err.data.title,
                    text: err.data.message,
                    confirmButtonColor: "#3085d6",
                });
            }
        });
}
