import {createStore} from "vuex"
import httpError from "@/httpError"
import api from "@/api"

// Used for restoring the state to clean slate
const getDefaultState = () => ({searchResults: {}, bookList: []})

const store = createStore({
    state: {
        searchResults: {},
        bookList: [],
    },

    mutations: {
        setSearchResults: (state, results) => state.searchResults = results,
        resetState: state => Object.assign(state, getDefaultState()),
        setBookList: (state, books) => state.bookList = books,
    },

    actions: {
        /**
         * Send the search request and update the results locally
         *
         * @param commit
         * @param params
         * @returns {Promise}
         */
        search({commit}, params) {
            api.search(params)
                .then(response => commit('setSearchResults', response.data))
                .catch(e => httpError(e))
        },

        /**
         * Delete a book from the server and locally
         *
         * @param {Object}
         * @param {string} bookId
         * @returns {Promise}
         */
        deleteBook({commit, state}, bookId) {
            api.deleteBook(bookId)
                .then(() => {
                    const books = state.bookList.filter(book => book.id !== bookId)
                    commit('setBookList', books)
                })
                .catch(e => httpError(e))
        }
    }
})

export default store
