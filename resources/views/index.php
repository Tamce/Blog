<html>
<head>
	<title>Tamce - Technology and So On</title>
  <meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
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
            <li v-bind:class="{active: $route.name == 'blog'}"><router-link to="/blog">Blog</router-link></li>
            <li v-bind:class="{active: $route.name == 'post'}" v-if="$route.name == 'post'"><router-link :to="'/post/'+$route.params.hash">Post</router-link></li>
          </ul>
          <ul class="nav navbar-nav navbar-right">
            <p class="navbar-text" v-if="!!user">Signed in as {{user.name}}</p>
            <li v-if="!user && $route.name != 'login'"><router-link to="/login">Login</router-link></li>
          </ul>
        </div>
			</div>
		</div>
    <transition name="fade" mode="out-in">
      <!-- don't know why this f**king transition is no use -->
      <div class="view"><router-view></router-view></div>
    </transition>
    </div>
  </div>
  <script src="/static/js/jquery-3.2.1.min.js"></script>
	<script src="/static/js/vue.js"></script>
  <script src="/static/js/vue-router.js"></script>
	<script src="/static/js/bootstrap.min.js"></script>
	<link rel="stylesheet" href="/static/styles/bootstrap.min.css">
  <script src="/static/js/tmodule.js"></script>
	<script>
	(function () {
    var router = new VueRouter({
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
          path: '/post/:hash',
          component: tmodule.lazyComponent('post')
        }
      ]
    });
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
        user: null
      })
    });
    if (app) {
      clearInterval(id);
      delete id;
      $("#loading-vue").remove();
    } else {
      alert("An error occurred when loading essential js file! This page could not be shown properly!");
    }
	})();
	</script>
</body>
</html>
