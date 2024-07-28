import './bootstrap';
import configureCounter from './common/configureCounter';

document.querySelectorAll('input.char-counter').forEach( el => configureCounter(el) );
