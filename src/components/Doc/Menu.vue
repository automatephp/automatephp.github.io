<template>
  <ul class="menuDocumentation">
    <li class="automate">Documentation</li>
    <li
      v-for="link in menu"
      :key="link.link"
    >
      <router-link :to="link.link">{{ link.title }}</router-link>
    </li>
  </ul>
</template>

<script>
  export default {
    name: "doc-menu",
    props: {
      menu: {type: Array, default: () => []},
    },
  }
</script>
