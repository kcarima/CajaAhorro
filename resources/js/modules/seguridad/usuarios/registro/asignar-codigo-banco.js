function asignar_codigo_banco(e) {

    const parent = e.target.closest('[data-banco]');

    const numero_cuenta_container = parent.querySelector('.numero-cuenta-container');
    const numero_cuenta_input = numero_cuenta_container.querySelector('input');

    if(!numero_cuenta_input.value) {
        numero_cuenta_input.value = e.target.value;
    } else {
        if(numero_cuenta_input.value.substring(0, 4) != e.target.value) {
            numero_cuenta_input.value = e.target.value;
        }
    }

}

export default asignar_codigo_banco
