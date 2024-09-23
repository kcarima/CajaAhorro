import asignar_codigo_banco from "./asignar-codigo-banco";
import eliminar_banco from "./eliminar-banco";

// Logica del boton de agregar bancos
const btn_agregar_banco = document.getElementById('agregar-banco');

const configurar_banco_template = (indice_actual) => {

    const banco_template = document.getElementById('bancos-container').content.firstElementChild.cloneNode(true);

    banco_template.setAttribute('data-banco', indice_actual);

    // Obtenemos el contenedor que tiene el select de los bancos
    const banco_container = banco_template.querySelector('.banco-container');

    const name_banco_container = `banco[${indice_actual}][banco]`;

    // Obtenemos el label
    const label_banco_container = banco_container.querySelector('label');
    label_banco_container.setAttribute('for', name_banco_container);

    // Obtenemos el select
    const select_banco_container = banco_container.querySelector('select');
    select_banco_container.setAttribute('id', name_banco_container);
    select_banco_container.setAttribute('name', name_banco_container);
    select_banco_container.addEventListener('change', asignar_codigo_banco);

    // Obtenemos el contendor que tiene el select de los tipos de cuenta
    const tipo_cuenta_container = banco_template.querySelector('.tipo-cuenta-container');

    const name_tipo_cuenta_container = `banco[${indice_actual}][tipo]`;

    // Obtenemos el label
    const label_tipo_cuenta_container = tipo_cuenta_container.querySelector('label');
    label_tipo_cuenta_container.setAttribute('for', name_tipo_cuenta_container);

    // Obtenemos el select
    const select_tipo_cuenta_container = tipo_cuenta_container.querySelector('select');
    select_tipo_cuenta_container.setAttribute('id', name_tipo_cuenta_container);
    select_tipo_cuenta_container.setAttribute('name', name_tipo_cuenta_container);


    // Obtenemos el contendor que tiene el input de numero de cuenta
    const numero_cuenta_container = banco_template.querySelector('.numero-cuenta-container');

    const name_numero_cuenta_container = `banco[${indice_actual}][numero]`;

    // Obtenemos el label
    const label_numero_cuenta_container = numero_cuenta_container.querySelector('label');
    label_numero_cuenta_container.setAttribute('for', name_numero_cuenta_container);

    // Obtenemos el select
    const input_numero_cuenta_container = numero_cuenta_container.querySelector('input');
    input_numero_cuenta_container.setAttribute('id', name_numero_cuenta_container);
    input_numero_cuenta_container.setAttribute('name', name_numero_cuenta_container);

    // Obtenemos el boton de eliminar
    const btn_eliminar = banco_template.querySelector('.eliminar-banco');
    btn_eliminar.addEventListener('click', eliminar_banco);

    return banco_template;
}

btn_agregar_banco.addEventListener('click', () => {

    const ultimo_banco = [...document.querySelectorAll('[data-banco]')].slice(-1)[0];

    if(ultimo_banco) {

        const indice_ultimo_banco = ultimo_banco.getAttribute('data-banco');
        const indice_actual = parseInt(indice_ultimo_banco) + 1;

        ultimo_banco.after(configurar_banco_template(indice_actual));

    } else {

        document.getElementById('bancos-section').prepend(configurar_banco_template(0));

    }

});
