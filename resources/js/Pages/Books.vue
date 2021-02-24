<template>
    <breeze-authenticated-layout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                My List
            </h2>
        </template>

        <div class="flex w-3/4 lg:w-1/2 mx-auto mt-12">
            <my-list :books="books"></my-list>
        </div>

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

    created() {
        this.$store.commit('setBookList', this.books)
    }
}
</script>
