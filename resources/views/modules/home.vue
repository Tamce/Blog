<template>
  <div class="container-fluid">
    <div class="col-md-6 col-md-offset-3">
      <post v-for="post in posts" :key="post.hash" v-bind="post" @click.native="detail(post.shortname)"></post>
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
  },
  methods: {
    detail: function (shortname) {
      this.$router.push({name: 'post', params: { shortname: shortname }})
    }
  }
}
</script>
<style>
</style>
