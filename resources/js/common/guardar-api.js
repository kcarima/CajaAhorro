import axios from "axios";
import Swal from "sweetalert2";
import { desplegar_validation_error } from "../utils/validation-error";
import formInputValidation from "../common/validaciones/formInputValidation";
import shiftToError from "./shiftToError";

export default async function guardar() {

    this.setAttribute('disabled', '');
    this.textContent = 'Cargando...';

    let form, validation_section;
    /* Si el boton tiene el atributo form significa que el boton por alguna razon (valida) no esta dentro
    del form, por lo cual tenemos que localizarlo y localizar en donde se colocaran los errores en caso de
    que hayan */
    if(this.hasAttribute('form')) {
        form = document.getElementById(this.getAttribute('form'));
        validation_section = document.querySelector(`[data-form-error=${this.getAttribute('form')}]`);
    } else {
        form = this.closest('form');
        validation_section = form.parentElement.parentElement;
    }

    const validationResult = await formInputValidation();

    if(validationResult) {
        const formData = new FormData(form);

        axios.post(form.getAttribute('action'), formData)
        .then( res => {
            Swal.fire({
                icon: 'success',
                title: res.data.title,
                text: res.data.message,
                confirmButtonColor: '#3085d6'
            }).then( result => {
                if(!res.data.redirect) {
                    window.location.reload();
                } else {
                    window.location.href = res.data.redirect;
                }
            } );

        } ).catch( err => {

            if(err.response.status == 400) {

                desplegar_validation_error(form, err.response);

            } else {

                Swal.fire({
                    icon: 'error',
                    title: err.response.data.title,
                    text: err.response.data.message,
                    confirmButtonColor: '#3085d6'
                });

            }

        } );
    } else {

        const $errorAside = document.querySelector('.error-aside');

        if(!$errorAside) {
            const $errorTemplate = document.getElementById('error-aside-template');

            if($errorTemplate) {
                const $error = $errorTemplate.content.cloneNode(true);
                $error.firstElementChild.addEventListener('click', shiftToError);
                form.append($error.firstElementChild);
                this.classList.add('hidden');
            }
        }

    }

    this.removeAttribute('disabled');
    this.textContent = 'Enviar';

}
