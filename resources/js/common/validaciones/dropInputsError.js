const dropInputsError = (validationData) => {
    document.querySelector(`ul[data-input="${ validationData.input.name }"]`)?.remove();
}

export default dropInputsError;
