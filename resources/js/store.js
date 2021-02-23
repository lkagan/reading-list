import {createStore} from "vuex"
import api from "./api"

const getDefaultState = () => ({ searchResults: {} })

const store = createStore({
    state: {
        // Google Book API search results
        searchResults: {},
    },

    mutations: {
        setSearchResults: (state, results) => state.searchResults = results,
        resetState: state => Object.assign(state, getDefaultState())
    },

    actions: {
        /**
         * Send the search request and update the results locally
         *
         * @param commit
         * @param params
         * @returns {Promise<void>}
         */
        async search({commit}, params) {
            api.search(params)
                .then(response => commit('setSearchResults', response.data))
                .catch(e => {
                    if (! e?.response) {
                        alert('No network connection')
                    } else {
                        alert('🚨 Oops, something went wrong')
                    }
                    console.log(e)
                })
        }
    }
})

export default store
