import Vue from 'vue';
import Router from 'vue-router';
import Login from './views/Login.vue';
import Register from './views/Register.vue';
import Posts from './views/Posts.vue';

Vue.use(Router);

export const router = new Router({
  mode: 'history',
  routes: [
    {
      path: '/',
      name: 'home',
      component: Posts
    },
    {
      path: '/api/login',
      component: Login
    },
    {
      path: '/api/logout',
      component: Login
    },
    {
      path: '/api/register',
      component: Register
    },
    { path: "/posts",
      component: Posts
    },
  ]
});

router.beforeEach((to, from, next) => {
  const publicPages = ['/api/login', '/api/register'];
  const authRequired = !publicPages.includes(to.path);
  const loggedIn = localStorage.getItem('token');

  // trying to access a restricted page + not logged in
  // redirect to login page
  if (authRequired && !loggedIn) {
    next('/api/login');
  } else {
    next();
  }
});
