<template>
    <div class="bg-white shadow-sm sm:rounded-lg m-1 p-4 flex"
         v-if="!bookAdded">
        <div class="mr-5">
            <img :src="book.volumeInfo.imageLinks?.smallThumbnail"/>
        </div>
        <div class="block w-full h-full">
            <h3 class="font-bold">{{ book.volumeInfo.title }}</h3>
            <span class="italic text-gray-500 text-sm"
                  v-if="book.volumeInfo.authors">
                By {{ book.volumeInfo.authors.join(', ') }}
            </span>
            <br>
            <button
                @click="submit(book.id, book.volumeInfo.title)"
                class="add-to-list mt-3 btn"
            >
                Add to list
            </button>
        </div>
    </div>
</template>

<script>
import api from "@/api"
import httpError from "@/httpError";
import Button from "@/Components/Button"

export default {
    name: "SearchResultItem",
    components: {Button},

    data() {
        return {
            bookAdded: false
        }
    },

    props: {
        book: {
            type: Object,
            required: true,
        }
    },

    methods: {
        submit(remote_id, title) {
            api.addBook(remote_id, title)
                .then(response => {
                    this.bookAdded = true
                    alert('Added ' + response.data.data.title)
                })
                .catch(e => httpError(e))
        }
    }
}
</script>

<style scoped>
.add-to-list {
    font-size: .5em;
    padding: .5em;
    float: right;
}
</style>
