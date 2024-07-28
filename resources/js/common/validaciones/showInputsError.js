const showInputsError = (validationData) => {

    const validationTemplate = document.getElementById('validation-error-template').content.cloneNode(true);
    const ul = validationTemplate.querySelector('ul').cloneNode();
    const fragment = document.createDocumentFragment();

    for(let message of validationData.messages) {
        const li = validationTemplate.querySelector('li').cloneNode(true);
        li.append(message);
        fragment.append(li);
    }

    ul.setAttribute('data-input', validationData.input.name);
    ul.append(fragment);

    validationData.input.parentElement.append(ul);
}

export default showInputsError;
