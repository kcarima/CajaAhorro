import inputValidation from "./inputValidation";
import dropInputsError from "./dropInputsError";
import showInputsError from "./showInputsError";

const formInputValidation = async form => {

    let allFormInputs;

    if(form) {
        allFormInputs = [...form.querySelectorAll(".filled")];
    } else {
        allFormInputs = [...document.querySelectorAll(".filled")];
    }

    const evaluationPromise = allFormInputs.map( async (input) => await inputValidation(input) );

    const evaluationResult = await Promise.all(evaluationPromise);

    const inputsFailed = evaluationResult.filter( el => !el.ok );

    evaluationResult.forEach( el => dropInputsError(el) );

    if(inputsFailed) {
        inputsFailed.forEach( el => showInputsError(el) );
    }

    return inputsFailed.length === 0;
};

export default formInputValidation;
