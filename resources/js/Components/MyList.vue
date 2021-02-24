<template>
  <div class="text-center italic h-6">
    <span :class="{hidden: !reorderable}" class="text-gray-400">drag to change priority</span>
  </div>
  <div class="flex w-3/4 lg:w-1/2 mx-auto">
    <draggable class="dragArea list-group w-full" v-model="books">
      <div
          class="list-group-item bg-white m-1 p-3 rounded-md flex"
          :class="{'cursor-move': reorderable}"
          v-for="book of books"
          :key="book.title"
      >
        <div class="w-7">{{ book.priority }}</div>
        <div class="flex-grow">{{ book.title }}</div>
        <div>
          <i
              class="cursor-pointer material-icons float-right text-red-600"
              @click="deleteBook(book)"
          >delete_forever</i>
        </div>
      </div>
    </draggable>
  </div>
</template>

<script>
import {VueDraggableNext} from 'vue-draggable-next'

export default {
  name: "MyList",

  props: {
    sort: {
      type: String,
      required: false
    }
  },

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
    // Only allow the user to reorder the books when sorting by priority.
    reorderable() {
      return this.sort === 'priority'
    },

    books: {
      get() {
        return this.$store.state.bookList
      },

      set(list) {
        this.$store.dispatch('reorder', list)
      }
    }
  }
}
</script>
