import axios from "axios";
import Swal from "sweetalert2";

const btn_reset = document.getElementById('reset-password');

function resetPassword() {

    const cedula = this.dataset.cedula;

    const data = {
        cedula
    }

    axios.post(this.dataset.url, data)
    .then( res => {

        if(res.data.success) {

            Swal.fire({
                icon: 'success',
                title: res.data.message,
                text: res.data.data,
                confirmButtonColor: '#3085d6'
            });

        } else {

            Swal.fire({
                icon: 'error',
                title: res.data.message,
                text: res.data.data,
                confirmButtonColor: '#3085d6'
            });

        }
    } )
    .catch( err => console.log(err) )

}

btn_reset.addEventListener('click', resetPassword);
