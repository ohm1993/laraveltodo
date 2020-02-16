require('./bootstrap');
window.Vue = require('vue');
import VueRouter from 'vue-router';
Vue.use(VueRouter);
import VueAxios from 'vue-axios';
import axios from 'axios';
// axios.defaults.headers.common = {
//     'X-Requested-With': 'XMLHttpRequest',
//     'X-CSRF-TOKEN' : document.querySelector('meta[name="csrf-token"]').getAttribute('content')
// };
import App from './App.vue';
Vue.use(VueAxios, axios);
import Register from './components/Register.vue';
import Login from './components/Login.vue';
import Job from './components/Job.vue';
import CompleteJob from './components/CompleteJob.vue';
Vue.component('spinner', require('vue-simple-spinner'));
const routes = [
    {
        path: '/register',
        name: 'register',
        component: Register
    },
    {
        path: '/',
        name: 'login',
        component: Login
    },
    {
        name: 'job',
        path: '/job',
        component: Job
    },
    {
        name: 'complete',
        path: '/complete',
        component: CompleteJob
    }
  ];

const router = new VueRouter({ mode: 'history', routes: routes});
const app = new Vue(Vue.util.extend({ router }, App)).$mount('#app');
