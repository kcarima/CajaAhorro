const inputFileValidation = async (input, report) => {

    if(input.files.length > 0) {

        const file = input.files[0];
        const dataAttributes = input.getAttributeNames().filter( el => el.includes('data') );
        const dimensionsAttributes = ['data-min-height', 'data-height', 'data-max-height', 'data-min-width', 'data-width', 'data-max-width'];
        let objectURL = undefined;
        let img = undefined;
        const size = file.size / 1024;

        if(dataAttributes.some( el =>  dimensionsAttributes.includes(el))) {
            objectURL = URL.createObjectURL(file);
            img = await loadImage(objectURL);
            URL.revokeObjectURL(objectURL);
        }

        if(dataAttributes.includes('data-size') && size != parseInt(input.dataset.size)) {
            report.ok = false;
            report.messages.push(`El archivo debe de tener un peso de ${input.dataset.size}kb.`);
        }

        if(dataAttributes.includes('data-min-size') && size < parseInt(input.dataset.minSize)) {
            report.ok = false;
            report.messages.push(`El archivo debe de tener al menos un peso menor de ${input.dataset.minSize}kb.`);
        }

        if(dataAttributes.includes('data-max-size') && size > parseInt(input.dataset.maxSize)) {
            report.ok = false;
            report.messages.push(`El archivo debe de tener un peso menor de ${input.dataset.maxSize}kb.`);
        }

        if(dataAttributes.includes('data-height') && img.height != parseInt(input.dataset.height)) {
            report.ok = false;
            report.messages.push(`La imagen debe tener un alto de ${input.dataset.height}px.`);
        }

        if(dataAttributes.includes('data-max-height') && img.height > parseInt(input.dataset.maxHeight)) {
            report.ok = false;
            report.messages.push(`La imagen debe tener un alto menor de ${input.dataset.maxHeight}px.`);
        }

        if(dataAttributes.includes('data-min-height') && img.height < parseInt(input.dataset.minHeight)) {
            report.ok = false;
            report.messages.push(`La imagen debe tener un alto mayor de ${input.dataset.minHeight}px.`);
        }

        if(dataAttributes.includes('data-width') && img.width != parseInt(input.dataset.width)) {
            report.ok = false;
            report.messages.push(`La imagen debe tener un ancho de ${input.dataset.width}px.`);
        }

        if(dataAttributes.includes('data-max-width') && img.width > parseInt(input.dataset.maxWidth)) {
            report.ok = false;
            report.messages.push(`La imagen debe tener un ancho menor de ${input.dataset.maxWidth}px.`);
        }

        if(dataAttributes.includes('data-min-width') && img.width < parseInt(input.dataset.minWidth)) {
            report.ok = false;
            report.messages.push(`La imagen debe tener un ancho mayor de ${input.dataset.minWidth}px.`);
        }

    }

}

const loadImage = path => {
    return new Promise( (resolve, reject) => {
        const img = new Image();
        img.crossOrigin = 'Anonymous';
        img.src = path;
        img.onload = () => {
            resolve(img);
        }
        img.onerror = e => {
            reject(e);
        }
    } );
}

export default inputFileValidation;
