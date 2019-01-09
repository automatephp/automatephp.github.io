import Router from 'vue-router'
import Home from '../components/Home/Main'
import Doc from '../components/Doc/Doc'

const docPages = [
  {
    path: '/doc',
    name: 'docStarted',
    md: require('../../static/doc/get-started.md'),
    title: 'Get started',
    description: 'Documentation to configure Automate.',
  },
  {
    path: '/doc/deployment',
    name: 'docDeploy',
    md: require('../../static/doc/deployment.md'),
    title: 'Launching a deployment',
    description: 'All the elements to launch a deployment with Automate.',
  },
  {
    path: '/doc/plugins',
    name: 'docPlugins',
    md: require('../../static/doc/plugins.md'),
    title: 'Plugins',
    description: 'A list of plugins to use with Automate.',
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
      description: d.description,
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
