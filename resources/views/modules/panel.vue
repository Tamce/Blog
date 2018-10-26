<template>
  <div>
    <h2>Panel</h2>
    <div class="col-md-4 col-md-offset-4">
      <ul class="list-group">
        <li class="list-group-item" v-for="(post, index) in posts" :key="index">
          {{post.topic}}
          <span @click="trash(index)" class="glyphicon glyphicon-trash tmc-item-icon"></span>
          <span @click="edit(index)" class="glyphicon glyphicon-pencil tmc-item-icon"></span>
        </li>
        <li @click="add" class="list-group-item" style="text-align: center;">
          <span class="glyphicon glyphicon-plus"></span>
        </li>
      </ul>
    </div>
  </div>
</template>
<style>
.tmc-item-icon {
  margin-right: 20px;
  float: right;
  line-height: 20px;
}
</style>

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
  }),
  methods: {
    edit: function (idx) {
      let shortname = this.posts[idx].shortname;
      this.$router.push({name: 'edit', params: { shortname: shortname }});
    },
    trash: function (idx) {
      let shortname = this.posts[idx].shortname;
      $.ajax({
        url: '/api/posts/' + shortname,
        method: 'DELETE'
      }).then(d => {
        this.posts.splice(idx, 1);
      }).catch(e => {
        alert('删除失败');
        console.log(e);
      });
    },
    add: function (e) {
      this.$router.push({name: 'edit', params: { shortname: '_new' }});
    }
  }
}
</script>
