import Router from 'vue-router'
import Home from '../components/Home/Main'
import Doc from '../components/Doc/Doc'

const docPages = [
  {
    path: '/docs',
    name: 'docStarted',
    md: require('../../static/doc/get-started.md'),
    title: 'Get started',
  },
  {
    path: '/docs/deployment',
    name: 'docDeploy',
    md: require('../../static/doc/deployment.md'),
    title: 'Launching a deployment',
  },
  {
    path: '/docs/plugins',
    name: 'docPlugins',
    md: require('../../static/doc/plugins.md'),
    title: 'Plugins',
  },
];

const routes = [
  {
    path: '/',
    name: 'home',
    component: Home,
  },
];

const menu = [];
docPages.forEach((d) => {
  menu.push({ title: d.title, link: d.path });
});


docPages.forEach((d) => {
  routes.push({
    path: d.path,
    name: d.name,
    component: Doc,
    props: {
      title: d.title,
      md: d.md,
      menu,
    },
  });
});

export default new Router({
  mode: 'history',
  routes,
  scrollBehavior () {
    return { x: 0, y: 0 }
  },
});
