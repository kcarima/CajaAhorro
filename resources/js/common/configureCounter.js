import '../components/character-counter';

export default function configureCounter(input) {

    if(input.hasAttribute('minlength') || input.hasAttribute('maxlength')) {
        const charCounter = document.createElement('characters-counter');
        charCounter.setAttribute('data-input', input.id);

        if(!input.hasAttribute('required')) {
            charCounter.classList.add('hidden');
        }

        input.addEventListener('input', e => {

            if(e.target.value.length == 0) {
                if(!e.target.hasAttribute('required')) {
                    charCounter.classList.add('hidden');
                } else {
                    charCounter.classList.remove('hidden');
                }
            } else {
                charCounter.classList.remove('hidden');
            }
            charCounter.update();
        });

        input.parentElement.append(charCounter);
    }

}
