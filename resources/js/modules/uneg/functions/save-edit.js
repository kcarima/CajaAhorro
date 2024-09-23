import save from "../../sca/configuraciones/functions/save-edit";
import refresh_save_btn from "./refresh_save_btn";

export default async function save_edit(e) {
    const save_edit_binded = save.bind(this);
    await save_edit_binded(e);
    const refresh_save_btn_binded = refresh_save_btn.bind(this);
    refresh_save_btn_binded(e);
}
