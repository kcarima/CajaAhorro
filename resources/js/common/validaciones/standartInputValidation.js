import inputFileValidation from "./inputFileValidation";

const standartInputValidation = async (input, report) => {

    if(input.validity.patternMismatch) {
        report.ok = false;
        report.messages.push('Ha proporcionado un formato incorrecto.');
    }

    if(input.validity.rangeOverflow) {
        report.ok = false;
        report.messages.push(`Valor proporcionado no debe ser mayor de ${ input.getAttribute('max') }.`);
    }

    if(input.validity.rangeUnderflow) {
        report.ok = false;
        report.messages.push(`Valor proporcionado no debe ser menor de ${ input.getAttribute('min') }.`);
    }

    if(input.validity.tooLong) {
        report.ok = false;
        report.messages.push(`Texto proporcionado no debe sobrepasar los ${ input.getAttribute('maxlength') } caracteres (caracteres utilizados ${ input.value.length }).`);
    }

    if(input.validity.tooShort) {
        report.ok = false;
        report.messages.push(`Texto proporcionado debe ser mayor de ${ input.getAttribute('minlength') } caracteres (caracteres utilizados ${ input.value.length }).`);
    }

    if(input.hasAttribute('required')) {
        if(input.validity.valueMissing || input.value.trim().length == 0) {
            report.ok = false;
            report.messages.push('El campo es obligatorio.');
        }
    }

    if(input.validity.typeMismatch) {
        switch (input.type) {
            case "number":
                report.ok = false;
                report.messages.push('Valor proporcionado debe de ser un número.');
            case "date":
                report.ok = false;
                report.messages.push('Valor proporcionado debe de ser una fecha.');
            default:
                report.ok = false;
                report.messages.push('Valor proporcionado debe de ser un texto.');
        }
    }

    if(input.validity.stepMismatch) {
        report.ok = false;
        report.messages.push(`Valor proporcionado no corresponde con los pasos definidos (pasos ${ input.getAttribute('step') }).`);
    }

    if(input.validity.badInput) {
        report.ok = false;
        report.messages.push('Ha proporcionado un valor incorrecto.');
    }

    if(input.type == 'file') {
        await inputFileValidation(input, report);
    }

    if(input.type == 'password' && input.hasAttribute('required')) {
        let name = input.name;
        if(input.name.includes('[')) {
            const posi_init = input.name.lastIndexOf('[');
            const posi_fin = input.name.lastIndexOf(']');
            name = input.name.substring(posi_init, posi_fin);
        }
        const confirm_password = document.querySelector(`input[name*="${name}_confirmation"]`);

        if(confirm_password && confirm_password.value != input.value) {
            report.ok = false;
            report.messages.push('La contraseña proporcionada no coinciden');
        }
    }

}

export default standartInputValidation;
