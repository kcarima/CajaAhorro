function limpiar_validation_error() {
    // Si hay un validation error lo quitamos
    const validation_error = document.querySelector('.validation-error');

    if (validation_error) {
        validation_error.parentElement.removeChild(validation_error);
    }
}

function desplegar_validation_error(parent, res) {

    let validation_error = document.querySelector('.validation-error');
    const template = document.getElementById('validation-error-template').content.firstElementChild;

    if (!validation_error) {
        validation_error = template.cloneNode(true);
        parent.prepend(validation_error);
    }

    validation_error.querySelector('h2').textContent = res.data.title;
    validation_error.querySelector('ul').innerHTML = '';

    const fragment = document.createDocumentFragment();

    for (let data in res.data.data) {
        if (res.data.data[data].length > 1) {
            for (let value of res.data.data[data]) {
                const li = template.querySelector('li').cloneNode(true);
                li.append(value);
                fragment.append(li);
            }
        } else {
            const li = template.querySelector('li').cloneNode(true);
            li.append(res.data.data[data]);
            fragment.append(li);
        }
    }

    validation_error.querySelector('ul').append(fragment);

    document.body.scrollIntoView({
        block: "start", behavior: "smooth"
    });

}

export { limpiar_validation_error, desplegar_validation_error }
