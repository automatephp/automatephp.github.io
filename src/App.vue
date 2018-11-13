<template>
  <div id="app">
    <router-view :key="$route.fullPath"/>
  </div>
</template>

<script>
  export default {
    name: 'app',
  }
</script>
