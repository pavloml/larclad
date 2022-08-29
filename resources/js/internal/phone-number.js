/**
 * Formats a phone number in the provided input element to the NANP format
 * @param {HTMLInputElement} inputElement
 */
exports.formatNumberInput = (inputElement) => {
    const removeLastChar = () => {
        inputElement.value = inputElement.value.slice(0, -1);
    }

    // const isDigit = (char) => {
    //     return !Number.isNaN(Number.parseInt(char));
    // }

    const clearInput = () => {
        inputElement.value = '';
    }

    const formatInput = () => {
        const clearValue = inputElement.value.replace(/\D/g, '');

        if (clearValue.length > 10) {
            removeLastChar();
            return;
        } else if (clearValue.length === 0) {
            clearInput();
            return;
        }

        const areaCode = clearValue.slice(0, 3);
        const exchangeCode = clearValue.slice(3, 6);
        const stationCode = clearValue.slice(6, 10);

        let resultString = '(';
        resultString = resultString.concat(areaCode);

        if (areaCode.length === 3 && exchangeCode.length > 0) {
            resultString = resultString.concat(') ', exchangeCode);
            if (exchangeCode.length === 3 && stationCode.length > 0){
                resultString = resultString.concat('-', stationCode);
            }
        }

        inputElement.value = resultString;
    }

    inputElement.addEventListener('input', formatInput);
}

/**
 * Formats a phone number to the NANP format
 * @param {String} phoneNumber Phone number in E.164 format
 * @return {String} Phone number in the NANP format
 */
exports.formatToLocal = (phoneNumber) => {
    return phoneNumber.replace(/\+1(\d{3})(\d{3})(\d+)/, '($1) $2-$3');
}
