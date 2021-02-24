/**
 * Collection of API calls.
 */
export default {
    /**
     * Send the HTTP search request
     *
     * @param {Object} params
     * @return {Promise}
     */
    search(params) {
        const defaults = {
            maxResults: 10,
            startIndex: 0,
            key: process.env.MIX_BOOK_API_KEY,
            fields: 'totalItems,items(id,volumeInfo(title,authors,description,imageLinks))',
        }

        return axios.get(
            process.env.MIX_BOOK_API_URL + '/volumes',
            {params: {...defaults, ...params}}
        )
    },

    /**
     * Delete a book from the reading list
     *
     * @param {String} bookId
     * @returns {Promise<AxiosResponse<any>>}
     */
    deleteBook(bookId) {
        return axios.delete(`/books/${bookId}`)
    }
}
