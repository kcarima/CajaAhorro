import '../../../utils/inputs/fecha-maxima';
import './registro/agregar-banco';
import './registro/select-banco';
import './registro/enviar-formulario';
import './editar/reiniciar-password';
import './registro/agregar-beneficiario';
import eliminar_banco from './registro/eliminar-banco';

const btns_eliminar_banco = document.querySelectorAll('.eliminar-banco');
const btns_eliminar_beneficiario = document.querySelectorAll('.eliminar-beneficiario');

btns_eliminar_banco.forEach( el => {
    el.addEventListener('click', eliminar_banco);
} );

btns_eliminar_beneficiario.forEach( el => {
    el.addEventListener('click', eliminar_banco);
} );
