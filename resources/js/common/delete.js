import Swal from "sweetalert2";
import confirm_delete from "./delete/confirm-delete";
import confirm_def_delete from "./delete/confirm-def-delete";


const asignar_eventos_btn = () => {
    const del_btns = document.querySelectorAll('.del-btn:not(.del-listener)');
    const del_def_btns = document.querySelectorAll('.del-def-btn:not(.def-del-listener)');

    del_btns.forEach(el => el.addEventListener('click', confirm_delete));
    del_def_btns?.forEach(el => el.addEventListener('click', confirm_def_delete));
}

asignar_eventos_btn();

Livewire.on('message-alert', data => {

    if (data.success) {
        Swal.fire({
            icon: 'success',
            title: data.title,
            text: data.message,
            confirmButtonColor: '#3085d6'
        });
    } else {
        Swal.fire({
            icon: 'error',
            title: data.title,
            text: data.message,
            confirmButtonColor: '#3085d6'
        });
    }

    // Asignamos el evento a los nuevos botones
    asignar_eventos_btn();

});

Livewire.on('refresh-listeners', () => {
    asignar_eventos_btn();
});
