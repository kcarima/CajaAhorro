import './bootstrap';
import 'bootstrap4-toggle/css/bootstrap4-toggle.min.css';
import 'bootstrap4-toggle/js/bootstrap4-toggle.min.js';

import configureCounter from './common/configureCounter';

document.querySelectorAll('input.char-counter').forEach( el => configureCounter(el) );

import $ from 'jquery';
window.$ = $;
