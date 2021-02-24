<template>
    <breeze-authenticated-layout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                My List
            </h2>
        </template>

        <div class="flex w-3/4 lg:w-1/2 mx-auto mt-12">
            <draggable class="dragArea list-group w-full" :list="books">
                <div
                    class="list-group-item bg-white m-1 p-3 rounded-md"
                    v-for="book of books"
                    :key="book.title"
                >
                    {{ book.title }}
                </div>
            </draggable>
        </div>

    </breeze-authenticated-layout>
</template>

<script>
import BreezeAuthenticatedLayout from '@/Layouts/Authenticated'
import { VueDraggableNext } from 'vue-draggable-next'

export default {
    name: 'Books',

    props: {
        books: {
            type: Array,
            required: true
        }
    },

    components: {
        BreezeAuthenticatedLayout,
        draggable: VueDraggableNext,
    }
}
</script>
