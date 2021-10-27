/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue').default;

import BootstrapVue from 'bootstrap-vue'

Vue.use(BootstrapVue)

import router from './router'

/**
 * Vue components
 */

 import App from './layouts/App.vue'


const app = new Vue({
    router,
    el: '#app',
    render: h => h(App)
});
