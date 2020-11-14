<template>
  <div class="card w-100 mt-2">
    <div class="card-header">
      <div class="card-description">
        <h2>{{ title }}</h2>
      </div>
      <div class="card-author">{{ author }}</div>
    </div>
    <div class="card-body">
      <div class="card-description">{{ description }}</div>
      <div class="card-content">{{ content }}</div>
    </div>
  </div>
</template>

<script>
export default {
  name: "Post",
  props: {
    content: {
      type: String,
      required: true
    },
    title: {
      type: String,
      required: true
    },
    description: {
      type: String,
      required: true
    }
  }
};
</script>
