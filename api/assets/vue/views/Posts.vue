<template>
  <div>
    <div class="row col">
      <form>
        <div class="form-row">
          <div class="col-8">
            <label class="label-title">Title</label>
            <input
            v-model="title"
            type="text"
            class="form-control"
            >
          </div>
        </div>
        <div class="form-row">
          <div class="col-8">
            <label class="label-content">Content</label>
            <input
              v-model="content"
              type="text-area"
              class="form-control"
            >
          </div>
        </div>
        <div class="form-row">
          <div class="col-8">
            <button
              :disabled="content.length === 0 || isLoading"
              type="button"
              class="btn btn-primary"
              @click="createPost()"
            >
              Create
            </button>
          </div>
        </div>
      </form>
    </div>
  </div>
</template>

<script>
import Post from "../components/Post";

export default {
  name: "Posts",
  components: {
    Post
  },
  data() {
    return {
      content: "",
      title: "",
      description: ""
    };
  },
  computed: {
    isLoading() {
      return this.$store.getters["post/isLoading"];
    },
    hasError() {
      return this.$store.getters["post/hasError"];
    },
    error() {
      return this.$store.getters["post/error"];
    },
    hasPosts() {
      return this.$store.getters["post/hasPosts"];
    },
    posts() {
      return this.$store.getters["post/posts"];
    }
  },
  methods: {
    async createPost() {
      const result = await this.$store.dispatch("post/create", this.$data);
      if (result !== null) {
        console.log(result)
      }
    },
  }
};
</script>
