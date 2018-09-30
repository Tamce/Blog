<template>
<div>
  <div class="head-pic"></div>
  <div class="container-fluid">
    <div class="col-md-6 col-md-offset-3">
      <post v-for="post in posts" :key="post.hash" v-bind="post" @click.native="detail(post.shortname)"></post>
    </div>
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
.head-pic {
    width: 100%;
    height: 300px;
    background-image: url(/static/head.jpg);
    background-size: cover;
    background-position: center 60%;
    margin-top: -20px;
    color: white;
    text-align: center;
    line-height: 300px;
    font-size: 3em;
}
.head-pic::before {
  content: "Tamce Technology";
  background-color: rgba(0,0,0,.2);
  width: 100%;
  height: 300px;
  position: absolute;
  display: block;
  font-family: -apple-system,BlinkMacSystemFont,San Francisco,Helvetica Neue,Helvetica,Ubuntu,Roboto,Noto,Segoe UI,Arial,sans-serif;
}
</style>
