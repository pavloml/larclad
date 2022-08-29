/**
 * Adds a post to favorites
 *
 * @param {Number} postId
 */
exports.addPostToFavorites = (postId) => {
    let favorites = JSON.parse(localStorage.getItem('favorites'));
    favorites.push(postId);
    localStorage.setItem('favorites', JSON.stringify(favorites));
}

/**
 * Removes a post from favorites
 * @param {Number} postId
 */
exports.removePostFromFavorites = (postId) => {
    let favorites = JSON.parse(localStorage.getItem('favorites'));
    favorites.splice(favorites.indexOf(postId));
    localStorage.setItem('favorites', JSON.stringify(favorites));
}

/**
 * Checks if given post is in favorites
 *
 * @param {Number} postId
 * @returns {Boolean}
 */
exports.checkIfPostInFavorites = (postId) => {
    let favorites = JSON.parse(localStorage.getItem('favorites'));
    return favorites.includes(postId);
}

/**
 * Checks if multiple posts are in favorites
 *
 * @param {Array} postsIds
 * @returns {Array}
 */
exports.checkIfPostsInFavorites = (postsIds) => {
    let favorites = JSON.parse(localStorage.getItem('favorites'));
    let favorite_posts_found = [];

    postsIds.forEach(function (postId) {
        if (favorites.includes(postId)) {
            favorite_posts_found.push(postId);
        }
    })

    return favorite_posts_found;
}

