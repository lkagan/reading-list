import {createStore} from "vuex"
import httpError from "@/httpError"
import api from "@/api"

// Used for restoring the state to a clean slate
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
        async deleteBook({commit, state, dispatch}, bookId) {
            let books

            try {
                // Delete the book
                await api.deleteBook(bookId)
                books = state.bookList.filter(book => book.id !== bookId)
                commit('setBookList', books)
            } catch(e) {
                httpError(e)
            }

            dispatch('reorder', books)
        },

        /**
         * Update the priority values to be consecutive (remove gaps)
         *
         * @param state
         * @param commit
         * @param books
         */
        reorder({state, commit}, books) {
            const copy = [...state.bookList]
            copy.sort((a, b) => a.priority < b.priority ? -1 : 1)
            let priority = 1
            copy.forEach(book =>  book.priority = priority++ )

            // Send the updated priorities to the server
            const priorityMap = state.bookList.map(book => {
                return {id: book.id, priority: book.priority}
            })

            api.reorder(priorityMap)
                .then(commit('setBookList', books))
                .catch(e => httpError(e))
        },

        /**
         * Change the priority of values based on list order
         *
         * @param state
         * @param commit
         */
        changeOrder({state, commit}, books) {
            let priority = 1
            books.forEach(book =>  book.priority = priority++ )

            // Send the updated priorities to the server
            const priorityMap = books.map(book => {
                return {id: book.id, priority: book.priority}
            })

            api.reorder(priorityMap)
                .then(commit('setBookList', books))
                .catch(e => httpError(e))
        },

        /**
         * Alphabetize the list by title.
         *
         * @param commit
         * @param state
         */
        alphabetize({commit, state}) {
            const books = state.bookList.sort((a, b) => {
                return a.title.toLowerCase() < b.title.toLowerCase() ? -1 : 1
            })
            commit('setBookList', books)
        },

        /**
         * Sort the list by priority.
         *
         * @param commit
         * @param state
         */
        prioritize({commit, state}) {
            const books = state.bookList.sort((a, b) => a.priority < b.priority ? -1 : 1)
            commit('setBookList', books)
        },
    }
})

export default store
