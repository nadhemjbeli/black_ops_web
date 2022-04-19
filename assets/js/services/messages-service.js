import axios from 'axios';
/**
 // * @param {string|null} categoryIri
 // * @param {string|null} searchTerm
 * @returns {Promise}
 */
export function fetchMessages() {
// export function fetchMessages(categoryIri, searchTerm) {
    // const params = {};
    // if (categoryIri) {
    //     params.category = categoryIri;
    // }
    //
    // if (searchTerm) {
    //     params.name = searchTerm;
    // }

    return axios.get('/api/messages');
}
