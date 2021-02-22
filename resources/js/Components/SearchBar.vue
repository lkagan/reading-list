<template xmlns="http://www.w3.org/1999/html">
    <div class="container mx-auto content-center">
        <form @submit.prevent="submit">
            <div class="">
                <input type="search" class="w-full mb-3"
                       placeholder="search books" v-model="search"/>
                <input type="submit" value="search"
                       class="bg-blue-700 hover:bg-blue-500 text-white py-1 px-2"/>
            </div>
        </form>
    </div>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <ul>
                        <li v-for="book of searchResults.items">
                            <img
                                :src="book.volumeInfo.imageLinks?.smallThumbnail"/>
                            ID: {{ book.id }}<br>
                            Title: {{ book.volumeInfo.title }} <br>
                            <template v-if="book.volumeInfo.authors">
                                Author: {{ book.volumeInfo.authors.join(', ') }}
                            </template>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import { mapState, mapMutations } from 'vuex'

export default {
    name: "SearchBar",

    data() {
        return {
            search: ''
        }
    },

    computed: {
        ...mapState(['searchResults'])
    },

    methods: {
        ...mapMutations(['setSearchResults']),

        /**
         * Handle the search form submission
         */
        submit() {
            // Query parameters for the API call to Google Books
            const params = {
                maxResults: 10,
                startIndex: 0,
                fields: 'totalItems,items(id,volumeInfo(title,authors,description,imageLinks))',
                q: this.search
            }

            axios.get('/volumes', {params})
                .then(response => {
                    this.setSearchResults(response.data)
                })
                // If production code, handle this properly
                .catch(e => console.log(e.response))
        }
    }
}
</script>
