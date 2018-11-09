<template>
  <div class="container_starting section section4">
    <div class="starting">
      <h2>Get starting</h2>
      <p>You can download the latest version of Automate with the following command</p>
      <div class="command">
        <span>curl -LSs </span>https://automatephp.github.io/installer.php | php
      </div>
      <router-link
        :to="{ name: 'docStarted' }"
        class="btn_orange">
        Documentation
      </router-link>
    </div>
  </div>
</template>

<script>
  export default {
    name: "home-starting",
  }
</script>
