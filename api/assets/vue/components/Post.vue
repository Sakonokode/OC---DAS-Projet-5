<template>
<div class="card">
  <img class="card-img-top" src="https://via.placeholder.com/350x150" alt="Card image cap">
  <div class="card-body">
    <h5 class="card-title">{{ title }}</h5>
  </div>
  <div class="card-footer">
    <small class="text-muted">Last updated 3 mins ago</small>
    <div class="float-right">{{ author }}</div>
  </div>
</div>
</template>

<script>
export default {
  name: "Post",
  props: {
    author: {
      type: String,
      required: true
    },
    content: {
      type: String,
      required: true
    },
    title: {
      type: String,
      required: true
    },
    thumbnail: {
      type: String,
      required: true
    }
  }
};
</script>
