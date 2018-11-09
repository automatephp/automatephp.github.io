<template>
  <div id="app">
    <router-view :key="$route.fullPath"/>
  </div>
</template>

<script>
  export default {
    name: 'app',
    metaInfo() {
      return {
        title: 'Automate',
        titleTemplate: '%s | Automate',
        meta: [
          { name: 'description', content: 'Automate allows you to automate your deployments to remote Linux servers simply.'},
        ],
      }
    },
  }
</script>
