import formInputValidation from "./validaciones/formInputValidation";

export default async function shiftToError() {

    const resultValidation = await formInputValidation();

    if(!resultValidation) {
        const $listError = document.querySelector('.list-error');
        $listError.parentElement.parentElement.scrollIntoView({'behavior': 'smooth'});

    } else {
        document.getElementById('btn-enviar').classList.remove('hidden');
        this.remove();
    }

}
