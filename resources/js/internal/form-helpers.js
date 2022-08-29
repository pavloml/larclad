/**
 * Checks if the price field is available for selected category
 * @param {HTMLSelectElement} categoryField
 */
exports.checkIfPriceFieldAvailable = (categoryField) => {
    const selectedCategory = categoryField.querySelector(`option[value='${categoryField.value}']`);
    console.log(selectedCategory.dataset.priceAvailable);
    if (selectedCategory.dataset.priceAvailable === 'false') {
        this.togglePriceField('hide');
    } else {
        this.togglePriceField('show')
    }
}

/**
 * Shows or hides the price field
 * @param {String} action Show or hide the price field
 * @param {boolean} clearInputValue Clear the price field value in case of hiding
 */
exports.togglePriceField = (action, clearInputValue = false) => {
    const priceField = document.querySelector('#priceField');
    const priceInput = priceField.querySelector('#price');
    console.log(priceField.style.display);

    if (action === 'hide') {
        if (clearInputValue) {
            priceInput.value = '';
        }
        priceField.style.display = 'none';
    } else if (priceField.style.display !== 'block') {
        priceField.style.display = 'block';
    }
}

exports.showPassword = (button, event, passwordInputId) => {
    event.preventDefault();
    const passwordInput = document.getElementById(passwordInputId)
    this.togglePasswordVisibility(passwordInput, 'show');
    button.setAttribute('onclick', `formHelpers.hidePassword(this, event, '${passwordInputId}')`);
    button.setAttribute('arial-label', 'Hide password');
    button.innerHTML = '<i class="fas fa-eye-slash"></i>';
}

exports.hidePassword = (button, event, passwordInputId) => {
    event.preventDefault();
    const passwordInput = document.getElementById(passwordInputId)
    this.togglePasswordVisibility(passwordInput, 'hide');
    button.setAttribute('onclick', `formHelpers.showPassword(this, event, '${passwordInputId}')`);
    button.setAttribute('arial-label', 'Show password');
    button.innerHTML = '<i class="fas fa-eye"></i>';
}

/**
 * Shows or hides password
 * @param {HTMLInputElement} passwordInput
 * @param {String} action
 */
exports.togglePasswordVisibility = (passwordInput, action) => {
    if (action === 'show') {
        passwordInput.type = 'text';
    } else {
        passwordInput.type = 'password';
    }
}

/**
 * Modifies action of the search form
 * @param {HTMLFormElement} searchForm
 */
exports.searchFormHelper = (searchForm) => {
    const cityDropdown = searchForm.querySelector('#cityDropdown');
    const subcategoryDropdown = searchForm.querySelector('#subcategoryDropdown');
    searchForm.action = `/search/${cityDropdown.value ? cityDropdown.value : 'all'}`;

    if (subcategoryDropdown.value) {
        const option = subcategoryDropdown.querySelector(`option[value=${subcategoryDropdown.value}]`);
        console.log(option.dataset.category);
        searchForm.action += `/${option.dataset.category}/${subcategoryDropdown.value}`;
    }else {
        searchForm.action += '/all'
    }

    console.log(searchForm.action);
}
