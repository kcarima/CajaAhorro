class CharactersCounter extends HTMLElement {

    constructor() {
        super();
    }

    connectedCallback() {
        this.input = document.getElementById(this.getAttribute('data-input'));
        this.failClassMessage = ['text-red-600', 'dark:text-red-400', 'message'];
        this.fineClassMessage = ['text-green-600', 'dark:text-green-400', 'message'];
        this.append(document.getElementById('characters-counter-template').content.cloneNode(true));
        this.setCounter();
    }

    update() {
        this.setCounter();
    }

    setCounter() {

        if(!this.testMinLength()) {
            this.setMinLengthFailMessage();
            return;
        } else {
            if(!this.input.hasAttribute('maxlength')) {
                this.classList.add('hidden');
            }
        }

        if(!this.testMaxLength()) {
            this.setMaxLengthFailMessage();
            return;
        }

        if(this.input.getAttribute('maxlength')) {
            this.setMaxLengthFineMessage();
        } else {
            this.setMinLengthFineMessage();
        }
    }

    testMinLength() {
        const minLength = this.input.getAttribute('minlength');

        if(minLength) {
            if(this.input.value.length < minLength) {
                return false;
            }
        }

        return true;
    }

    testMaxLength() {
        const maxLength = this.input.getAttribute('maxlength');

        if(maxLength) {
            if(this.input.value.length > maxLength) {
                return false;
            }
        }

        return true;
    }

    setMinLengthFailMessage() {
        const message = this.querySelector('.message');
        const fail = this.querySelector('.fail-svg');
        const fine = this.querySelector('.fine-svg');

        fine.classList.add('hidden');
        fail.classList.remove('hidden');
        message.className = '';
        message.classList.add(...this.failClassMessage);
        message.textContent = `Mínimo caracteres: ${this.input.value.length}/${this.input.getAttribute('minLength')}`;
    }

    setMaxLengthFailMessage() {
        const message = this.querySelector('.message');
        const fail = this.querySelector('.fail-svg');
        const fine = this.querySelector('.fine-svg');

        fine.classList.add('hidden');
        fail.classList.remove('hidden');
        message.className = '';
        message.classList.add(...this.failClassMessage);
        message.textContent = `Máximo caracteres: ${this.input.value.length}/${this.input.getAttribute('minLength')}`;
    }

    setMinLengthFineMessage() {
        const message = this.querySelector('.message');
        const fine = this.querySelector('.fine-svg');
        const fail = this.querySelector('.fail-svg');

        fail.classList.add('hidden');
        fine.classList.remove('hidden');
        message.className = '';
        message.classList.add(...this.fineClassMessage);
        message.textContent = `Mínimo caracteres: ${this.input.value.length}/${this.input.getAttribute('minlength')}`;
    }

    setMaxLengthFineMessage() {
        const message = this.querySelector('.message');
        const fine = this.querySelector('.fine-svg');
        const fail = this.querySelector('.fail-svg');

        fail.classList.add('hidden');
        fine.classList.remove('hidden');
        message.className = '';
        message.classList.add(...this.fineClassMessage);
        message.textContent = `Máximo caracteres: ${this.input.value.length}/${this.input.getAttribute('maxlength')}`;
    }
}

customElements.define('characters-counter', CharactersCounter);
