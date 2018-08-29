<template>
  <div class="tmc-post">
    <div class="tmc-post-topic">{{post.topic}}</div>
    <div class="tmc-post-author">{{author.name}}</div>
    <div class="tmc-post-date">{{post.updated_at}}</div>
    <div class="tmc-post-summary">{{post.summary}}</div>
    <div class="tmc-post-body">{{post.body}}</div>
  </div>
</template>
<script>
export default {
  props: ['shortname'],
  beforeRouteEnter : function (to, from, next) {
    next(vm => {
      $.get('/api/posts?shortname=' + vm.shortname).then(d => {
        vm.post = d;
        vm.author = d.author;
      });
    });
  },
  data: () => {
    return {
      post: {},
      author: {}
    }
  }
}
</script>

