import {createStore} from "vuex"

const store = createStore({
    state: {
        searchResults: {},
    },

    mutations: {
        setSearchResults: (state, results) => state.searchResults = results,
    },

    actions: {}
})

export default store
