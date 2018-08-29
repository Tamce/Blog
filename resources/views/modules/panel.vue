<template>
  <div>
    <h2>Panel</h2>
    <ul>
      <li v-for="post in posts" :key="post.hash">
        {{post.topic}}
      </li>
    </ul>
  </div>
</template>
<script>
export default {
  beforeRouteEnter: (from, to, next) => {
    next(vm => {
      vm.user = vm.$root.user;
      if (!vm.$root.user) {
        // If first load app, the request may not finished so the 'user' is false.
        if (vm.$root.user === false) {
          // manually check again
          $.get('/api/profile').catch(e => {
            next('login');
          }).then(d => {
            vm.user = d;
          });
        } else {
          // If user logout, let us set it to undefined or null, not false
          next('login');
        }
      }
      $.get('/api/posts').then(d => {
        vm.posts = d.data;
      });
    });
  },
  data: () => ({
    posts: [],
    user: {}
  })
}
</script>
