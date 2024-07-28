import asignar_codigo_banco from "./asignar-codigo-banco";

const select_banco = [...document.querySelectorAll('.select-banco')];

select_banco.forEach( el => {
    el.addEventListener('change', asignar_codigo_banco);
} );
