<template>
    <div class="bg-white shadow-sm sm:rounded-lg m-1 p-4 flex" v-if="!bookAdded">
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
            axios.post(route('books.store'), { remote_id, title } )
            .then(response => {
                alert('Added ' + response.data.data.title)
                this.bookAdded= true
            })
            .catch(e => {
                if (!e.response) {
                    const msg = 'No network connection'
                } else {
                    alert('Could not add book to list.  See JS console.')
                    console.log(e.response)
                }
            })
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
