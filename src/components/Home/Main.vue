<template>
  <div>
    <main class="main-page">
      <div :class="viewScrolled ? 'home viewScrolled' : 'home'">
        <div class="'container_code section section1">
          <div class="spacing"></div>
          <div class="upper_home card1">
            <span class="fond"></span>
            <div class="ghost"></div>
            <div class="left">
              <div class="header">
                <h1 class="logo">Automate, A deployment tool<span></span></h1>
                <div class="line">
                  <router-link
                    :to="{ name: 'docStarted' }"
                    class="btn_blue"
                  >Documentation</router-link>
                  <a
                    class="btn_blue btn_git"
                    href="https://github.com/automatephp/automate"
                  >
                    <i class="fa fa-github "></i>Github
                  </a>
                </div>
              </div>
              <Title @go-to-discover="goToDiscover()"/>
            </div>

            <div class="right">

              <div
                id="card"
                class="flip-container vertical"
              >
                <div class="flipper">
                  <div
                    id="term"
                    class="front"
                  >
                    <Demo/>
                  </div>
                  <div class="back">
                    <config-example/>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>

        <div
          id="features"
          class="fake section section2"
        ></div>

        <Advantages/>

        <Starting/>
      </div>
    </main>
    <Footer loc="home"/>
  </div>
</template>

<script>
  import ConfigExample from './ConfigExample'
  import Advantages from './Advantages';
  import Starting from './Starting';
  import Footer from '../Footer';
  import Demo from './Demo';
  import Title from './Title';

  export default {
    name: "home-main",
    components: {
      Advantages,
      Starting,
      Footer,
      Demo,
      Title,
      ConfigExample,
    },
    data() {
      return {
        viewScrolled: false,
      }
    },
    mounted() {
      window.addEventListener('scroll', () => {
        this.viewScrolled = window.scrollY > 1;
      });
    },
    methods: {
      goToDiscover() {
        this.viewScrolled = true;
      },
    },
    metaInfo() {
      return {
        title: 'Automate, a PHP deployment tool',
        meta: [
          { name: 'description', content: 'Discover Automate, a PHP solution created in partnership with Eolas to automate deployment of your developments on remote Linux servers.'},
        ],
      }
    },
  }
</script>
