<template>
  <div>
    <main class="main-page docu">
      <div class="home documentation">
        <div class="container_code">
          <div class="spacing"></div>
          <div class="upper_home card1">
            <div class="left">
              <div class="header">
                <a href="/"><h1 class="logo">Automate, A deployment tool<span></span></h1></a>
                <div class="line">
                  <router-link
                    :to="{ name: 'home' }"
                    class="btn_blue"
                  >Home</router-link>
                  <a
                    class="btn_blue btn_git"
                    href="https://github.com/automatephp/automate"
                  >
                    <i class="fa fa-github "></i>Github
                  </a>
                </div>
                <Menu :menu="menu"/>
              </div>
            </div>

            <div class="right">
              <div class="inner">
                <vue-markdown class="doc-md">{{ md }}</vue-markdown>
              </div>
            </div>
          </div>
        </div>
      </div>
    </main>

    <Footer loc="doc"/>
  </div>
</template>

<script>
  import VueMarkdown from 'vue-markdown'
  import Menu from './Menu';
  import Footer from '../Footer';

  export default {
    name: 'doc',
    components: {
      VueMarkdown,
      Footer,
      Menu,
    },
    props: {
      md: {type: String, required: true},
      menu: {type: Array, required: true},
      title: {type: String, required: true},
      description: {type: String, required: true},
    },
    metaInfo() {
      return {
        title: this.title + ' - Automate Documentation',
        meta: [
          { name: 'description', content: this.description},
        ],
      }
    },
  }
</script>
