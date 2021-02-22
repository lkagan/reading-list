<template>
    <breeze-authenticated-layout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Search
            </h2>
        </template>

        <div class="py-12">
            <search-bar></search-bar>
        </div>
    </breeze-authenticated-layout>
</template>

<script>
    import BreezeAuthenticatedLayout from '@/Layouts/Authenticated'
    import SearchBar from "@/Components/SearchBar";

    export default {
        components: {
            SearchBar,
            BreezeAuthenticatedLayout,
        },
    }
</script>
