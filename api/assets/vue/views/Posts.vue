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
            <label>Media
              <input type="file" id="media" ref="media" v-on:change="handleFileUpload()"/>
            </label>
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
import authHeader from '../services/auth-header';
import axios from 'axios';

export default {
  name: "Posts",
  components: {
    Post
  },
  data() {
    return {
      content: "",
      title: "",
      media: ""
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
      let data = {
        'media': this.media,
        'content': this.content,
        'title': this.title,
      };

      let result = await this.$store.dispatch("post/create", data);
      
      if (result !== null) {
        console.log('create post result = ', result)
      }
    },
    async handleFileUpload(){
      this.media = this.$refs.media.files[0];
      let formData = new FormData();

      /*
          Add the form data we need to submit
      */
      formData.append('file', this.media);
      await this.$store.dispatch("media/create", formData).then(response => {
        console.log('response in vue', response)
        this.media = response['@id']
      });
      
    }
  }
};
</script>
