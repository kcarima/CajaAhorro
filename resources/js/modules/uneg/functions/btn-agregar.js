import cancelar_agregar from "./cancelar-agregar";
import agregar_campo from "./agregar-campo";

const btn_agregar = document.getElementById('btn-agregar');

btn_agregar.addEventListener('click', () => {

    const tabla = document.querySelector('table');
    const create_row = document.getElementById('create-row').content.firstElementChild.cloneNode(true);

    tabla.querySelector('tbody').prepend(create_row);

    // Agregamos la funcionalidad al boton agregar
    const btn_guardar = create_row.querySelector('[data-url]');
    btn_guardar.addEventListener('click', agregar_campo);

    // Agregamos la funcionalidad al boton de cancelas
    const btn_cancelar = create_row.querySelector('.dropdown-item:not([data-url])');
    btn_cancelar.addEventListener('click', cancelar_agregar);

});
