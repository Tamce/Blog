<template>
  <div class="container-fluid">
    <div class="col-md-6 col-md-offset-3">
      <post v-for="post in posts" :key="post.hash" v-bind="post"></post>
    </div>
  </div>
</template>
<script>
export default {
  beforeRouteEnter : function (to, from, next) {
    $.get('/api/posts').then(d => {
      next(vm => {
        vm.posts = d.data;
      });
    });
  },
  data: () => {
    return {
      posts: []
    }
  }
}
</script>
<style>
</style>
