import shiftToError from "../../../../../common/shiftToError";

function mostrarErrorPorcentajes() {

    const $inputsBeneficiarios = [
        ...document.querySelectorAll(".porcentaje-beneficiarios"),
    ];

    const $porcentajeTotal = $inputsBeneficiarios
    .map((el) => parseInt(el.value))
    .reduce((accumulator, currentValue) => accumulator + currentValue, 0);

    if($porcentajeTotal != 100) {
        $inputsBeneficiarios.forEach(el => {
            let $list = el.parentElement.querySelector('ul');
            let $li;
            const $span = document.createElement('span');
            $span.classList.add('porcentaje-error');
            $span.textContent = "El % de adjudicación de todos los beneficiarios debe dar como total 100."
            if(!$list) {
                const validationTemplate = document.getElementById('validation-error-template').content.cloneNode(true);
                $list = validationTemplate.querySelector('ul').cloneNode();
                $li = validationTemplate.querySelector('li').cloneNode();
                $li.append(validationTemplate.querySelector('svg').cloneNode(true));
                $li.append($span);
                $list.append($li);
                el.parentElement.append($list);
            } else {
                if(!$list.querySelector('.porcentaje-error')) {
                    $li = $list.querySelector('li').cloneNode();
                    $li.append($list.querySelector('svg').cloneNode(true));
                    $li.append($span);
                    $list.append($li);
                }
            }

        });
    }

}

function errorSidebarEvents() {
    const shiftToErrorBind = shiftToError.bind(this);
    shiftToErrorBind();
    mostrarErrorPorcentajes();
}

export default function verificarPorcentajeBeneficiarios() {

    const $inputsBeneficiarios = [
        ...document.querySelectorAll(".porcentaje-beneficiarios"),
    ];

    const $porcentajeTotal = $inputsBeneficiarios
        .map((el) => parseInt(el.value))
        .reduce((accumulator, currentValue) => accumulator + currentValue, 0);

    if ($porcentajeTotal != 100) {
        const $errorAside = document.querySelector(".error-aside");

        if (!$errorAside) {
            const $errorTemplate = document.getElementById(
                "error-aside-template"
            );

            if ($errorTemplate) {
                const $error = $errorTemplate.content.cloneNode(true);
                $error.firstElementChild.addEventListener("click", errorSidebarEvents);
                document.body.append($error.firstElementChild);
                document.getElementById('btn-enviar').classList.add("hidden");
                mostrarErrorPorcentajes();
            }
        }
    } else {
        document.querySelectorAll('.porcentaje-error')?.forEach( el => el.parentElement.remove() );
    }
}
