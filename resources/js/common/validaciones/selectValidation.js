const selectValidation = (input, report) => {
    if(input.hasAttribute('required') && input.value.trim() == '') {
        report.ok = false;
        report.messages.push('El campo es obligatorio.');
    }
}

export default selectValidation;
