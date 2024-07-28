// Colocar que los input de fecha tengan una fecha maxima el dia actual
const inputs_fecha = [...document.querySelectorAll('input[type="date"]')];

const today = new Date();
let dd = today.getDate();
let mm = today.getMonth() + 1;
const yyyy = today.getFullYear();

if(dd < 10) {
    dd = '0' + dd;
}

if(mm < 10) {
    mm = '0' + mm;
}

inputs_fecha.forEach( el => {
    let today = `${yyyy}-${mm}-${dd}`;
    el.setAttribute('max', today);
} );
