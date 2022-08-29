/**
 * Replaces text content in the given element
 * @param {Element} element
 * @param {String} text
 */

exports.replaceText = (element, text) => {
    element.textContent = text;
}

/**
 * Updates provided badges
 * @param badges
 * @param badgeValue
 */
exports.updateBadges = (badges, badgeValue) => {
    badges.forEach(badge => badge.textContent = badgeValue !== 0 ? badgeValue.toString() : '');
}

/**
 * Adds deferred CSS
 * @param {String} link url of a css file
 */
exports.addDeferredCSS = (link) => {
    const linkElement = document.createElement('link');
    linkElement.setAttribute('rel', 'stylesheet');
    linkElement.setAttribute('href', link);
    const head = document.querySelector('head');
    head.appendChild(linkElement);
}

/**
 * Removes all children of provided node
 * @param {Node} node
 */
exports.removeChildren = (node) => {
    while (node.firstChild) {
        node.removeChild(node.lastChild);
    }
}
