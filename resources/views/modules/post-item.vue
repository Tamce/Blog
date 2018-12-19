<template>
  <!-- The component that shows as lists (home page) -->
  <div class="tmc-post-item">
    <div class="tmc-post-item-heading">
      <span class="tmc-post-topic">{{topic}}</span>
      <span class="tmc-post-author"><span class="glyphicon glyphicon-user" />&nbsp;{{author.name}}</span>
      <span class="tmc-post-time"><span class="glyphicon glyphicon-time" />&nbsp;{{updated_at}}</span>
    </div>
    <div class="tmc-post-item-body">
      <div class="tmc-post-summary">{{summary}}</div>
    </div>
  </div>
</template>
<script>
export default {
  props: ['hash', 'topic', 'body', 'summary', 'shortname', 'created_at', 'updated_at', 'author'],
}
</script>
<style>
.tmc-post-item {
  margin: 10px 0;
  border-bottom: 1px solid #ddd;
  padding: 12px 20px;
}
.tmc-post-topic {
  font-size: 2em;
  width: 50%;
  display: inline-block;
}
.tmc-post-author {
  display: inline-block;
  margin-right: 10px;
}
</style>
