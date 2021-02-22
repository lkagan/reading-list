<template xmlns="http://www.w3.org/1999/html">
    <div class="container mx-auto content-center">
        <form @submit.prevent="submit">
            <div class="">
                <input type="search" class="w-full mb-3"
                       placeholder="search books" v-model="query"/>
                <input type="submit" value="search"
                       class="bg-blue-700 hover:bg-blue-500 text-white py-1 px-2"/>
            </div>
        </form>
    </div>
</template>

<script>

export default {
    name: "SearchBar",

    data() {
        return {
            query: ''
        }
    },

    methods: {
        // Handle the search form submission
        submit() {
            // Query parameters for the API call to Google Books
            const params = {
                startIndex: 0,
                q: this.query
            }

            this.$store.dispatch('search', params)
        }
    }
}
</script>
