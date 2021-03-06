<html>
<head>
	<title>Tamce - Technology and So On</title>
  <meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <style>
   .en-font {
    font-family: -apple-system,BlinkMacSystemFont,San Francisco,Helvetica Neue,Helvetica,Ubuntu,Roboto,Noto,Segoe UI,Arial,sans-serif;
   }
  </style>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@3.3.7/dist/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
</head>
<body>
  <div id="loading-vue">
    <center><h3>Loading Website, Please Wait<span id="looping-point"></span><br /></h3><small>FrontEnd Powered by Vue and Bootstrap</small></center>
    <script>id=(()=>{e=document.getElementById("looping-point");i=1;return setInterval(()=>{i=i>6?1:i;e.innerText=".".repeat(i++);},200);})()</script>
  </div>
	<div id="app">
    <div style="display: none;" v-show="loaded">
      <div id="navbar" class="navbar navbar-default">
        <div class="container-fluid">
          <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#nav-body" aria-expanded="false">
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
            </button>
            <router-link class="navbar-brand" to="/">Tamce</router-link>
          </div>
          <div class="collapse navbar-collapse" id="nav-body">
            <ul class="nav navbar-nav">
              <li v-bind:class="{active: $route.name == 'home'}"><router-link to="/">Home</router-link></li>
              <li v-bind:class="{active: $route.name == 'post'}" v-if="$route.name == 'post'"><a href="#">Post</a></li>
            </ul>
            <ul class="nav navbar-nav navbar-right">
              <p class="navbar-text" v-if="!!user"><router-link to="/panel" class="navbar-link">Signed in as {{user.name}}</router-link></p>
              <li v-if="!user && $route.name != 'login'"><router-link to="/login">Login</router-link></li>
            </ul>
          </div>
        </div>
      </div>
      <transition name="fade" mode="out-in">
        <!-- don't know why this f**king transition is no use -->
        <div class="view"><router-view @login="login"></router-view></div>
      </transition>
    </div>
    <hr style="width:80%;" />
    <center style="margin-bottom: 32px;">Copyright &copy; 2018 by Tamce, All rights reserved.</center>
  </div>
  <script src="/static/js/jquery-3.2.1.min.js"></script>
	<script src="/static/js/vue.js"></script>
  <script src="/static/js/vue-router.js"></script>
	<script src="/static/js/bootstrap.min.js"></script>
  <script src="/static/js/tmodule.js"></script>
	<script>
	(function () {
    var router = new VueRouter({
      mode: 'history',
      routes: [
        {
          name: 'blog',
          path: '/blog',
          component: tmodule.lazyComponent('blog')
        }, {
          name: 'home',
          path: '/',
          component: tmodule.lazyComponent('home')
        }, {
          name: 'login',
          path: '/login',
          component: tmodule.lazyComponent('login')
        }, {
          name: 'post',
          path: '/post/:shortname',
          component: tmodule.lazyComponent('post'),
          props: true
        }, {
          name: 'panel',
          path: '/panel',
          component: tmodule.lazyComponent('panel')
        }, {
          name: 'edit',
          path: '/edit/:shortname',
          component: tmodule.lazyComponent('edit')
        }, {
          name: 'notFound',
          path: '*',
          component: tmodule.lazyComponent('notFound')
        }
      ]
    });
    Vue.component('post', tmodule.lazyComponent('post-item'));
    // Don't know why nothing happened with <transition>, using hook to do the animation
    router.beforeEach((to, from, next) => {
      $(".view").css("display", "none");
      next();
    });
    router.afterEach((route) => {
      setTimeout(() => $(".view").fadeIn(), 50);
    });
		var app = new Vue({
      el: "#app",
      router: router,
      data: () => ({
        loaded: true,
        user: false
      }),
      methods: {
        login: function (d) {
          this.user = d;
        }
      }
    });
    clearInterval(id);
    delete id;
    $("#loading-vue").remove();
    $.get('/api/profile').then(d => {
      app.user = d;
    });
	})();
	</script>
</body>
</html>
