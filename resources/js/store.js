import {createStore} from "vuex"
import api from "./api"

const store = createStore({
    state: {
        // Google Book API search results
        searchResults: {},
    },

    mutations: {
        setSearchResults: (state, results) => state.searchResults = results,
    },

    actions: {
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
