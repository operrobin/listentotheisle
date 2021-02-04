/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

import Vue from 'vue'

import VueRouter from 'vue-router';

import Vuex from 'vuex'

import 'animate.css'
import 'fullpage-vue/src/fullpage.css'
import 'vue-slick-carousel/dist/vue-slick-carousel.css'

import VueSlickCarousel from 'vue-slick-carousel'

import VueFullpage from 'fullpage-vue'

import 'fullpage.js/vendors/scrolloverflow' // Optional. When using scrollOverflow:true
// import './fullpage.scrollHorizontally.min' // Optional. When using fullpage extensions
import VueFullPage from 'vue-fullpage.js'

import MarqueeText from 'vue-marquee-text-component'

import { BootstrapVue, IconsPlugin } from 'bootstrap-vue'

import { routes } from './router';

import store from './components/Store'

Vue.use(VueRouter);

Vue.use(VueFullPage);

Vue.use(Vuex);

Vue.use(VueFullpage);

Vue.component('VueSlickCarousel', VueSlickCarousel);

const router = new VueRouter({
    mode: 'history',
    routes
});

window.router = router;

// Install BootstrapVue
Vue.use(BootstrapVue)
Vue.component('marquee-text', MarqueeText)

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./components', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))

Vue.component('header-component', require('./components/Layouts/HeaderComponent.vue').default);
Vue.component('footer-component', require('./components/Layouts/FooterComponent.vue').default);
Vue.component('footer-info', require('./components/Layouts/Footer/FooterInfo.vue').default);
Vue.component('player-info', require('./components/Layouts/Footer/PlayerInfo.vue').default);

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const isle = new Vue({
    el: '#isle',
    router,
    store
});
