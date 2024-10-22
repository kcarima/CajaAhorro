/* Funcion para actualizar el enlace de edicion. Es necesario en los casos donde hay un input para cambiar
el codigo de alguna tabla, el enlace de edicion tambien se debe de actualizar al depender de ese codigo nuevo
*/
export default function refresh_save_btn(e) {

    e.preventDefault();

    const parent = this.closest('tr');
    const span_codigo = parent.querySelector('.td-codigo span');
    if(span_codigo) {
        const url_raw = document.querySelector('button.hidden[data-url]').dataset.url;

        this.dataset.url = url_raw.replace(/\d{6}/, span_codigo.textContent.trim());
    }

}
