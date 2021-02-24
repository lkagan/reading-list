<template>
    <breeze-authenticated-layout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                My List
            </h2>
        </template>
        <div class="text-center mt-12 mb-5">
            <label class="mr-5">Sort by:</label>
            <input
                type="radio"
                class="form-radio mr-2"
                @click="$store.dispatch('alphabetize')"
                name="sort"
                v-model="sort"
                value="title"
            > title
            <input
                type="radio"
                class="form-radio ml-7 mr-2"
                @click="$store.dispatch('prioritize')"
                name="sort"
                v-model="sort"
                value="priority"
            > priority
        </div>
        <my-list :books="books" :sort="sort"></my-list>
    </breeze-authenticated-layout>
</template>

<script>
import BreezeAuthenticatedLayout from '@/Layouts/Authenticated'
import MyList from "@/Components/MyList";

export default {
    name: 'Books',

    props: {
        books: {
            type: Array,
            required: true
        }
    },

    components: {
        MyList,
        BreezeAuthenticatedLayout
    },

    data() {
        return {
            sort: 'priority'
        }
    },

    created() {
        this.$store.commit('setBookList', this.books)
    }
}
</script>
