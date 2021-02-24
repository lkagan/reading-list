<template>
  <draggable class="dragArea list-group w-full" :list="books">
    <div
        class="list-group-item bg-white m-1 p-3 rounded-md cursor-move"
        v-for="book of books"
        :key="book.title"
    >
      {{ book.title }}
      <i
          class="cursor-pointer material-icons float-right text-red-600"
          @click="deleteBook(book)"
      >delete_forever</i>
    </div>
  </draggable>
</template>

<script>
import { VueDraggableNext } from 'vue-draggable-next'

export default {
  name: "MyList",

  components: {
    draggable: VueDraggableNext,
  },

  methods: {
    /**
     * Delete the book from local store and remote DB
     *
     * @param book
     */
    deleteBook(book) {
      if (!confirm(`Are you sure you want to delete "${book.title}"?`)) {
        return
      }

      this.$store.dispatch('deleteBook', book.id)
    }
  },

  computed: {
    books() {
      return this.$store.state.bookList
    }
  }
}
</script>
