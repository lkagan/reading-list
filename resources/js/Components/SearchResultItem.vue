<template xmlns="http://www.w3.org/1999/html">
    <div class="bg-white shadow-sm sm:rounded-lg m-1 p-4 flex">
        <div class="mr-5">
            <img :src="book.volumeInfo.imageLinks?.smallThumbnail"/>
        </div>
        <div class="block w-full h-full">
            <h3 class="font-bold">{{ book.volumeInfo.title }}</h3>
            <span class="italic text-gray-500 text-sm" v-if="book.volumeInfo.authors">
                By {{ book.volumeInfo.authors.join(', ') }}
            </span>
            <br>
            <inertia-link href="/book" class="text-blue-600">more info</inertia-link>
            <br>
            <Button class="add-to-list mt-3">Add to list</Button>
        </div>
    </div>
</template>

<script>
import Button from "@/Components/Button"

export default {
    name: "SearchResultItem",
    components: {Button},
    props: {
        book: {
            type: Object,
            required: true,
        }
    }
}
</script>

<style scoped>
button.add-to-list {
    font-size: .5em;
    padding: .5em;
    float: right;
}
</style>
