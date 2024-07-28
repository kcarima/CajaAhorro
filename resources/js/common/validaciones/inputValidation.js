import standartInputValidation from "./standartInputValidation";
import selectValidation from "./selectValidation";

const inputValidation = async (input) => {

    const report = {ok: true, messages: [], input};

    if(input.tagName == 'INPUT') {
        await standartInputValidation(input, report);
    } else if(input.tagName == 'SELECT') {
        selectValidation(input, report);
    }

    return report;
}

export default inputValidation;
