import eliminar_banco from "./eliminar-banco";
import configureCounter from "../../../../common/configureCounter";
import verificarPorcentajeBeneficiarios from "./functions/verificarPorcentajeBeneficiarios";
import dayjs from "dayjs";

const btn_agregar_beneficiario = document.getElementById('agregar-beneficiario');

const configurar_beneficiario_template = (indice_actual) => {

    const beneficiario_template = document.getElementById('beneficiario-container').content.firstElementChild.cloneNode(true);

    beneficiario_template.setAttribute('data-beneficiario', indice_actual);

    // Obtenemos el contenedor que tiene el nombre del beneficiario
    const nombre_container = beneficiario_template.querySelector('.nombre-beneficiario-container');

    const name_nombre_container =`beneficiarios[${indice_actual}][nombre]`;

    // Obtenemos el label
    const label_nombre = nombre_container.querySelector('label');
    label_nombre.setAttribute('for', name_nombre_container);

    // Obtenemos el input
    const input_nombre = nombre_container.querySelector('input');
    input_nombre.setAttribute('id', name_nombre_container);
    input_nombre.setAttribute('name', name_nombre_container);
    configureCounter(input_nombre);

    // Obtenemos el contenedor que tiene la fecha de nacimiento del beneficiario
    const fecha_nacimiento_container = beneficiario_template.querySelector('.nacimiento-beneficiario-container');

    const name_fecha_nacimiento_container =`beneficiarios[${indice_actual}][fecha_nacimiento]`;

    // Obtenemos el label
    const label_fecha_nacimiento = fecha_nacimiento_container.querySelector('label');
    label_fecha_nacimiento.setAttribute('for', name_fecha_nacimiento_container);

    // Obtenemos el input
    const input_fecha_nacimiento = fecha_nacimiento_container.querySelector('input');
    input_fecha_nacimiento.setAttribute('id', name_fecha_nacimiento_container);
    input_fecha_nacimiento.setAttribute('name', name_fecha_nacimiento_container);
    input_fecha_nacimiento.setAttribute('max', dayjs().format('YYYY-MM-DD'));

    // Obtenemos el contenedor que tiene la cedula del beneficiario
    const cedula_container = beneficiario_template.querySelector('.cedula-beneficiario-container');

    const name_cedula_container =`beneficiarios[${indice_actual}][cedula]`;

    // Obtenemos el label
    const label_cedula = cedula_container.querySelector('label');
    label_cedula.setAttribute('for', name_cedula_container);

    // Obtenemos el input
    const input_cedula = cedula_container.querySelector('input');
    input_cedula.setAttribute('id', name_cedula_container);
    input_cedula.setAttribute('name', name_cedula_container);

    // Obtenemos el select de nacionalidad
    const select_cedula = cedula_container.querySelector('select');
    select_cedula.setAttribute('name', `beneficiarios[${indice_actual}][nacionalidad]`);

    // Obtenemos el contenedor que tiene el email del beneficiario
    const email_container = beneficiario_template.querySelector('.email-beneficiario-container');

    const name_email_container =`beneficiarios[${indice_actual}][email]`;

    // Obtenemos el label
    const label_email = email_container.querySelector('label');
    label_email.setAttribute('for', name_email_container);

    // Obtenemos el input
    const input_email = email_container.querySelector('input');
    input_email.setAttribute('id', name_email_container);
    input_email.setAttribute('name', name_email_container);

    // Obtenemos el contenedor que tiene el telefono del beneficiario
    const telefono_container = beneficiario_template.querySelector('.telefono-beneficiario-container');

    const name_telefono_container =`beneficiarios[${indice_actual}][telefono]`;

    // Obtenemos el label
    const label_telefono = telefono_container.querySelector('label');
    label_telefono.setAttribute('for', name_telefono_container);

    // Obtenemos el input
    const input_telefono = telefono_container.querySelector('input');
    input_telefono.setAttribute('id', name_telefono_container);
    input_telefono.setAttribute('name', name_telefono_container);

    // Obtenemos el contenedor que tiene el telefono secundario del beneficiario
    const telefono_secundario_container = beneficiario_template.querySelector('.telefono-secundario-beneficiario-container');

    const name_telefono_secundario_container =`beneficiarios[${indice_actual}][telefono_secundario]`;

    // Obtenemos el label
    const label_telefono_secundario = telefono_secundario_container.querySelector('label');
    label_telefono_secundario.setAttribute('for', name_telefono_secundario_container);

    // Obtenemos el input
    const input_telefono_secundario = telefono_secundario_container.querySelector('input');
    input_telefono_secundario.setAttribute('id', name_telefono_secundario_container);
    input_telefono_secundario.setAttribute('name', name_telefono_secundario_container);

    // Obtenemos el contenedor que tiene el select de parentesco
    const parentesco_container = beneficiario_template.querySelector('.parentesco-beneficiario-container');

    const name_parentesco_container = `beneficiarios[${indice_actual}][parentesco]`

    // Obtenemos el label
    const label_parentesco = parentesco_container.querySelector('label');
    label_parentesco.setAttribute('for', name_parentesco_container);

    // Obtenemos el select
    const input_parentesco = parentesco_container.querySelector('select');
    input_parentesco.setAttribute('id', name_parentesco_container);
    input_parentesco.setAttribute('name', name_parentesco_container);

    // Obtenemos el contenedor que tiene el porcentaje del beneficiario
    const porcentaje_container = beneficiario_template.querySelector('.porcentaje-beneficiario-container');

    const name_porcentaje_container =`beneficiarios[${indice_actual}][porcentaje]`;

    // Obtenemos el label
    const label_porcentaje = porcentaje_container.querySelector('label');
    label_porcentaje.setAttribute('for', name_porcentaje_container);

    // Obtenemos el input
    const input_porcentaje = porcentaje_container.querySelector('input');
    input_porcentaje.setAttribute('id', name_porcentaje_container);
    input_porcentaje.setAttribute('name', name_porcentaje_container);

    input_porcentaje.addEventListener('change', verificarPorcentajeBeneficiarios);

    // Obtenemos el contenedor que tiene la copia de la cédula del beneficiario
    const documento_cedula_container = beneficiario_template.querySelector('.documento-cedula-beneficiario-container');

    const name_documento_cedula_container =`beneficiarios[${indice_actual}][doc_cedula]`;

    // Obtenemos el label
    const label_documento_cedula = documento_cedula_container.querySelector('label');
    label_documento_cedula.setAttribute('for', name_documento_cedula_container);

    // Obtenemos el input
    const input_documento_cedula = documento_cedula_container.querySelector('input');
    input_documento_cedula.setAttribute('id', name_documento_cedula_container);
    input_documento_cedula.setAttribute('name', name_documento_cedula_container);

    // Obtenemos el boton de eliminar
    const btn_eliminar = beneficiario_template.querySelector('.eliminar-beneficiario');
    btn_eliminar.addEventListener('click', eliminar_banco);

    return beneficiario_template;
}

btn_agregar_beneficiario.addEventListener('click', () => {

    const ultimo_beneficiario = [...document.querySelectorAll('[data-beneficiario]')].slice(-1)[0];

    if(ultimo_beneficiario) {

        const indice_ultimo_beneficiario = ultimo_beneficiario.getAttribute('data-beneficiario');
        const indice_actual = parseInt(indice_ultimo_beneficiario) + 1;

        ultimo_beneficiario.after(configurar_beneficiario_template(indice_actual));

    } else {

        document.getElementById('beneficiarios-section').prepend(configurar_beneficiario_template(0));

    }

});
