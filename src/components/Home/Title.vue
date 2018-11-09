<template>
  <div>
    <div class="info">
      <h2 id="titleInfo1">One command line !</h2>
      <p>Automate allows you to automate your deployments to remote Linux servers simply. You can use Automate from your
      workstation or through an integration server like Travis or Gitlab-ci.</p>
      <a
        href="#"
        class="btnDiscover btn_orange"
        @click="$emit('go-to-discover')"
      >
        Discover !
      </a>
    </div>
    <div class="info info2">
      <h2 id="titleInfo2">One YAML file to organize everything</h2>
      <p>Define all linux environment you need and all command line on each to deploy your application simply from the
      repository Git.</p>
      <a
        v-scroll-to="'#features'"
        href="#"
        class="btnFeatures btn_orange"
      >Features</a>
    </div>
  </div>
</template>

<script>
  import Typewriter from 'typewriter-effect/dist/core';

  export default {
    name: 'home-title',
    mounted() {
      new Typewriter('#titleInfo1', {
        strings: 'One command line !',
        autoStart: true,
        delay: 80,
      });

      new Typewriter('#titleInfo2', {
        strings: 'One YAML file to organize everything',
        autoStart: true,
        delay: 40,
      });
    },
  }
</script>
