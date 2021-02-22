/**
 * Collection of API calls to Google Books.
 */
export default {
    /**
     * Send the HTTP search request
     *
     * @param {Object} params
     * @return {Promise}
     */
    async search(params) {
        const defaults = {
            maxResults: 10,
            startIndex: 0,
            fields: 'totalItems,items(id,volumeInfo(title,authors,description,imageLinks))',
        }

        return axios.get('/volumes', { params: { ...defaults, ...params} })
    }
}
