import cancel_edit from "./functions/cancel-edit";
import edit_value from "./functions/edit-value";
import save_edit from "./functions/save-edit";

const save_btn = document.querySelectorAll('.save-btn');
const cancel_btn = document.querySelectorAll('.cancel-btn');
const edit_btn = document.querySelectorAll('.edit-btn');

cancel_btn.forEach( el => el.addEventListener('click', cancel_edit) );
edit_btn.forEach( el => el.addEventListener('click', edit_value) );
save_btn.forEach( el => el.addEventListener('click', save_edit) );

