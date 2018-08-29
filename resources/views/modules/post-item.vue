<template>
  <div class="tmc-post-item" @click="detail">
    <div class="tmc-post-author">{{author.name}}</div>
    <div class="tmc-post-topic">{{topic}}</div>
    <div class="tmc-post-summary">{{summary}}</div>
    <div class="tmc-post-date">{{updated_at}}</div>
  </div>
</template>
<script>
export default {
  props: ['hash', 'topic', 'body', 'summary', 'shortname', 'created_at', 'updated_at', 'author'],
  methods: {
    detail: function (e) {
      this.$router.push({name: 'post', params: { shortname: this.shortname }})
    }
  }
}
</script>
