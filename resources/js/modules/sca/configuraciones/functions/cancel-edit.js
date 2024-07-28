export default function cancel_edit(e) {

    const parent = e.target.closest('tr');

    // Mostramos los span
    const spans = parent.querySelectorAll('span');
    spans.forEach( el => {
        el.classList.remove('hidden');
    } );

    // Hacemos invisible los input
    const inputs = parent.querySelectorAll('input');
    inputs.forEach( el => {
        el.classList.add('hidden');

        /* Reiniciamos el input a su valor por defecto, si es de tipo archivo eliminamos los archivos y si
        es de otro tipo que tenga el valor original.
        */
        if(el.getAttribute('type') == 'file') {
            el.value = '';
        } else {
            const span =  el.parentElement.querySelector('span');
            if(span) {
                el.value = span.textContent.trim();
            }
        }

    } );

    // Ocultamos los botones de guardar y cancelas
    const btn_save = parent.querySelector('.save-btn');
    btn_save.classList.add('hidden');

    this.classList.add('hidden');

    // Mostramos el boton de editar
    const btn_edit = parent.querySelector('.edit-btn');
    btn_edit.classList.remove('hidden');

    // Mostramos el boton de eliminar
    parent.querySelector('.del-btn')?.classList.remove('hidden');

    // Mostramos el boton de detalle usuarios
    parent.querySelector('.user-btn')?.classList.remove('hidden');

}
