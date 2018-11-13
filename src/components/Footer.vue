<template>
  <footer :class="inBottom ? 'site-footer inBottom' : 'site-footer'">
    <div
      class="inner"
    >
      <div class="left">
        <span>Sponsored by</span>
        <a
          href="https://www.eolas.fr/"
          class="eolas"
        >Eolas</a>
      </div>
      <div class="right">
        <router-link
          v-if="loc === 'home'"
          :to="{ name: 'docStarted' }"
          class="btn_white"
        >Documentation</router-link>
        <router-link
          v-else
          :to="{ name: 'home' }"
          class="btn_white"
        >Home</router-link>
        <a
          href="https://github.com/automatephp/automate"
          class="btn_white btn_git"
        >
          <i class="fa fa-github"></i>Github
        </a>
      </div>
    </div>
  </footer>
</template>

<script>
  export default {
    name: 'page-footer',
    props: {
      loc: {type: String, default: 'home'},
    },
    data() {
      return {
        inBottom: false,
      }
    },
    mounted() {
      this.handlerScroll();
      window.addEventListener('scroll', this.handlerScroll);
    },
    beforeDestroy() {
      window.removeEventListener('scroll', this.handlerScroll);
    },
    methods: {
      handlerScroll() {
        const heightWindow = isNaN(window.innerHeight) ? window.clientHeight : window.innerHeight;
        this.inBottom = (document.body.offsetHeight - 170) <= (heightWindow + document.documentElement.scrollTop);
      },
    },
  }
</script>
