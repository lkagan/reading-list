<template xmlns="http://www.w3.org/1999/html">
    <div class="container mx-auto content-center max-w-4xl">
        <form @submit.prevent="submit">
            <div class="">
                <input
                    type="search"
                    class="w-full mb-3"
                    placeholder="search books by title, author, etc..."
                    v-model="query"
                    required
                />
                <Button>Search</Button>
            </div>
        </form>
    </div>
</template>

<script>

import Button from "@/Components/Button";
export default {
    name: "SearchBar",
    components: {Button},
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
