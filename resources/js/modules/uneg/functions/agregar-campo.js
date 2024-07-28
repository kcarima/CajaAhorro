import Swal from "sweetalert2";
import edit_value from "../../sca/configuraciones/functions/edit-value";
import save_edit from "../../sca/configuraciones/functions/save-edit";
import cancel_edit from "../../sca/configuraciones/functions/cancel-edit";
import { limpiar_validation_error, desplegar_validation_error } from "../../../utils/validation-error";
import refresh_save_btn from "./refresh_save_btn";
import confirm_delete from "../../../common/delete/confirm-delete";
import confirm_def_delete from "../../../common/delete/confirm-def-delete";

const agregar_campos_tabla = (row, parent) => {
    const inputs_row = row.querySelectorAll('input');

    inputs_row.forEach( el => {
        const input_parent = parent.querySelector(`input[name="${ el.name }"]`);
        const span = el.parentElement.querySelector('span');

        if(el.type == "checkbox") {
            if(input_parent.checked) {
                el.checked = true;
                span.textContent = 'Sí';
                span.classList.add('text-green-500', 'font-bold');
            } else {
                span.textContent = 'No';
                span.classList.add('text-red-500', 'font-bold');
            }
        } else {
            if(input_parent) {
                el.value = input_parent.value;
                span.textContent = input_parent.value;
            }
        }

    } );

    parent.replaceWith(row);
}

// Funcion para establecer los botones de eliminar, editar, etc.
const set_standart_action_buttons = (row, res) => {

    const edit_btn = row.querySelector('.edit-btn');
    const save_btn = row.querySelector('.save-btn');
    const cancel_btn = row.querySelector('.cancel-btn');
    const delete_btn = row.querySelector('.del-btn');
    const def_delete_btn = row.querySelector('.del-def-btn');

    // Al edit btn le agregamos el enlace, reemplazando por el codigo del que se inserto
    const url_raw = document.querySelector('button.hidden[data-url]').dataset.url;

    edit_btn.addEventListener('click', edit_value);
    save_btn.addEventListener('click', save_edit);
    save_btn.addEventListener('click', refresh_save_btn);
    cancel_btn.addEventListener('click', cancel_edit);
    delete_btn.addEventListener('click', confirm_delete);
    def_delete_btn?.addEventListener('click', confirm_def_delete);

    delete_btn.setAttribute('data-id', res.data.data.id);
    def_delete_btn?.setAttribute('data-id', res.data.data.id);

    save_btn.setAttribute('data-url', url_raw.replace(/[0-9a-fA-F]{8}\b-[0-9a-fA-F]{4}\b-[0-9a-fA-F]{4}\b-[0-9a-fA-F]{4}\b-[0-9a-fA-F]{12}$/, res.data.data.id));
}

export default function agregar_campo() {

    const parent = this.closest('tr');
    const inputs = parent.querySelectorAll('input');

    const formData = new FormData();

    inputs.forEach(el => {
        if(el.getAttribute('type') == 'checkbox') {
            formData.append(el.getAttribute('name'), el.checked);

        } else {
            formData.append(el.getAttribute('name'), el.value.toUpperCase());
        }
    });

    axios.post(this.dataset.url, formData)
        .then(res => {

            limpiar_validation_error();

            Swal.fire({
                icon: 'success',
                title: res.data.title,
                text: res.data.message,
                confirmButtonColor: '#3085d6'

            }).then(result => {

                const row = document.getElementById('template-row').content.cloneNode(true);

                if(res.data.data?.id) {
                    row.querySelector('input[name="uuid"]').value = res.data.data.id;
                }

                set_standart_action_buttons(row, res);
                agregar_campos_tabla(row, parent);

            });

        }).catch(err => {
            if (err.response.status == 400) {
                desplegar_validation_error(parent, err.response);
            } else {

                Swal.fire({
                    icon: 'error',
                    title: err.response.data.title,
                    text: err.response.data.message,
                    confirmButtonColor: '#3085d6'
                });

            }
            console.log(err);
        });

}
