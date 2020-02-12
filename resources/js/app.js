/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

import router from '@/js/routes';

window.Vue = require('vue');


Vue.component('home-component', require('./views/App.vue').default);
Vue.component('pagination', require('laravel-vue-pagination'));
Vue.component('axios', require('axios'));


const app = new Vue({
    el: '#app',
    router,
});


