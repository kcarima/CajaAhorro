export default function edit_value(e) {

    const parent = e.target.closest('tr');

    // Ocultamos el span
    const spans = parent.querySelectorAll('span');

    spans.forEach( el => {
        el.classList.add('hidden');
    } );

    // Hacemos visible el input
    const inputs = parent.querySelectorAll('input');
    inputs.forEach( el => {
        el.classList.remove('hidden');
    } );

    // Mostramos los botones de guardar y cancelas
    const btn_save = parent.querySelector('.save-btn');
    btn_save.classList.remove('hidden');

    const btn_cancel = parent.querySelector('.cancel-btn');
    btn_cancel.classList.remove('hidden');

    // Ocultamos el boton de editar
    this.classList.add('hidden');

    // Ocultamos los botones de eliminar
    parent.querySelector('.del-btn')?.classList.add('hidden');
    parent.querySelector('.del-def-btn')?.classList.add('hidden');

    // Ocultamos el boton de detalle usuarios
    parent.querySelector('.user-btn')?.classList.add('hidden');

}
