window.$ = require('jquery');
require('bootstrap');
require('bootstrap-select');
require('bootstrap-fileinput');
require('bootstrap-fileinput/themes/fa5/theme.js');

window._ = require('lodash');
window.axios = require('axios');
window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';

window.favoritePosts = require('./internal/favorite-posts');
window.phoneNumber = require('./internal/phone-number');
window.helpers = require('./internal/helpers');
window.formHelpers = require('./internal/form-helpers');

if (localStorage.getItem('favorites') === null) {
    localStorage.setItem('favorites', JSON.stringify([]));
}

/**
 * Initializes bootstrap-fileinput for the provided input element
 * @param {String} fileInputId ID of an input
 */
window.loadPostImageInput = (fileInputId) => {
    $('#' + fileInputId).fileinput({
        minFileCount: 0,
        maxFileCount: 1,
        showUpload: false,
        theme: 'fa5',
        allowedFileExtensions: ['jpg', 'jpeg', 'png']
    });
}

