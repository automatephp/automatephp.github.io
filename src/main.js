
import 'babel-polyfill';
import Vue from 'vue'
import App from './App'
import router from './router'
import VueRouter from "vue-router";
import VueMarkdown from 'vue-markdown'
import VueScrollTo from 'vue-scrollto'
import Meta from 'vue-meta'
import VueAnalytics from 'vue-analytics'

import './assets/app.scss'

Vue.config.productionTip = false;

Vue.use(VueRouter);
Vue.use(VueScrollTo);
Vue.use(Meta);

// Analytics
Vue.use(VueAnalytics, {
  id: process.env.ANALYTICS_ID,
  router,
});

/* eslint-disable no-new */
new Vue({
  el: '#app',
  router,
  components: { App, VueMarkdown },
  template: '<App/>',
})
