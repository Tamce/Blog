<template>
  <div>
    {{shortname}}
  </div>
</template>
<script>
export default {
  beforeRouteEnter : function (to, from, next) {
    next(vm => {
      vm.shortname = vm.$route.params.shortname;
    });
  },
  data: () => ({
    shortname: ''
  })
}
</script>
