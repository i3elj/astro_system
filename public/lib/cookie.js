/**
 * @param {string} name cookie name
 *
 * @return {boolean} if cookie exists or not
 */
export function getCookie(name) {
    return document.cookie.split(';').some(c => c.trim().startsWith(name + '='))
}
