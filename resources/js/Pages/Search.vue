<template>
    <breeze-authenticated-layout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Search
            </h2>
        </template>
        <div class="py-12 mx-6">
            <search-bar></search-bar>
            <search-results v-if="Object.keys(results || {}).length" :results="results"></search-results>
        </div>
    </breeze-authenticated-layout>
</template>

<script>
import BreezeAuthenticatedLayout from '@/Layouts/Authenticated'
import SearchBar from "@/Components/SearchBar";
import SearchResults from "@/Components/SearchResults";
import { mapState } from 'vuex';

export default {
    name: 'Search',

    components: {
        SearchBar,
        SearchResults,
        BreezeAuthenticatedLayout,
    },

    computed: {
        ...mapState({ results: 'searchResults' }),
    }
}
</script>
