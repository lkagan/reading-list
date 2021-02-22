<template>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <ul>
                        <li v-for="book of results.items">
                            <img
                                :src="book.volumeInfo.imageLinks?.smallThumbnail"/>
                            ID: {{ book.id }}<br>
                            Title: {{ book.volumeInfo.title }} <br>
                            <template v-if="book.volumeInfo.authors">
                                Author: {{ book.volumeInfo.authors.join(', ') }}
                            </template>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</template>

<script>

export default {
    name: "SearchResults",

    props: {
        results: {
            type: Array,
            required: true,
        }
    }
}
</script>
