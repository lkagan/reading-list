<template>
    <div class="pt-12">
        <div style="text-align: center" v-if="results">{{ results.totalItems}} books found</div>
        <div class="max-w-6xl mx-auto lg:px-8">
            <div class="grid grid-cols-2">
                <SearchResultItem :book="book" v-for="book of results.items"></SearchResultItem>
            </div>
        </div>
    </div>
</template>

<script>

import SearchResultItem from "@/Components/SearchResultItem";
export default {
    name: "SearchResults",
    components: {SearchResultItem},
    props: {
        results: {
            type: Object,
            required: true,
        }
    }
}
</script>
