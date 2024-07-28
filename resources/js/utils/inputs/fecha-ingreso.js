// Colocamos como valor por defecto para las fechas de ingreso el dia actual
const inputs_fecha_ingreso = [...document.querySelectorAll('input[name*="ingreso"]')];

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



inputs_fecha_ingreso.forEach( el => {
    let today = `${yyyy}-${mm}-${dd}`;
    el.setAttribute('value', today);
} );
