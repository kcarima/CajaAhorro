function eliminar_banco(){
    const parent = this.parentElement;
    const ancestor = parent.parentElement;

    ancestor.removeChild(parent);
}

export default eliminar_banco;
