<template>
  <div>
    <form id="login-form" onsubmit="return false;">
      <input type="text" name="name" id="name" placeholder="username"/>
      <input type="password" name="password" id="password" placeholder="password"/>
      <input type="submit" value="Login" @click="login">
    </form>
  </div>
</template>
<script>
export default {
  methods: {
    login: function () {
      $.post('/api/login', $("#login-form").serialize()).then(d => {
        this.$emit('login', d);
        this.$router.push('panel');
      }).catch(e => {
        alert('Login failed.');
      });
    }
  }
}
</script>


