<template>
  <div class="container">
    <div class="row col-md-12">
      <div class="card-deck">
        <div
        v-if="isLoading"
        class="row col"
        >
        <p>Loading...</p>
        </div>

        <div
          v-else-if="hasError"
          class="row col"
        >
          <div
            class="alert alert-danger"
            role="alert"
          >
            {{ error }}
          </div>
        </div>

        <div
        v-else-if="!hasPosts"
        class="row col"
      >
        No posts!
        </div>
        <div
          v-for="post in posts"
          v-else
          :key="post.id"
          class="row col-4 post-container"
          >
          <post :title="post.title" :author="post.author" :content="post.content" :media="post.media" />
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import UserService from '../services/user.service';
import Post from "../components/Post";

export default {
  name: 'Home',
  components: {
    Post
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
  mounted() {
    this.$store.dispatch("post/findAll");
  }
};
</script>

<style scoped>
.card-deck {
  margin: 2rem 0 0 0;
}
.post-container {
  margin: 0 0 2rem 0;
}
</style>