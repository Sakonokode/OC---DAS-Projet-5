<template>
  <div class="container">
      {{content}}
  </div>
</template>
<script>
import UserService from '../services/user.service';

export default {
  name: 'Documentation',
  data() {
    return {
      content: ''
    };
  },
  mounted() {
    UserService.getDocumentation().then(
      response => {
        this.content = response.data;
      },
      error => {
        this.content =
          (error.response && error.response.data && error.response.data.message) ||
          error.message ||
          error.toString();
      }
    );
  }
};
</script>