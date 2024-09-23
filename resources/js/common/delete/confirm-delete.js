import Swal from "sweetalert2";

export default function confirm_delete() {

    Swal.fire({
        icon: 'question',
        title: '¿Estas seguro que desea eliminar este recurso?',
        text: '¡Una vez eliminado no podra ser recuperado!',
        showDenyButton: true,
        confirmButtonText: '¡Eliminar!',
        denyButtonText: 'Cancelar',
        reverseButtons: true,
        customClass: {
            confirmButton: 'swal-confirm-button',
            denyButton: 'swal-cancel-button'
        },
        buttonsStyling: false
    }).then((result) => {
        if (result.isConfirmed) {
            Livewire.dispatch(`${this.dataset.module}:delete`, { id: this.dataset.id });
        }
    });

    /* Le agregamos una clase para indicar que ya tienen el listener, de esta forma cuando se refresque el componente y
    se tenga que colocar el listener a los nuevos botones no se le coloquen a estos.
    */
    this.classList.add('del-listener');

}
