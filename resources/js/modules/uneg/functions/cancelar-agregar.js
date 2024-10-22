export default function cancelar_agregar() {

    const parent = this.closest('tr');

    parent.parentElement.removeChild(parent);

}
