require('./bootstrap');
window.Vue = require('vue');

import Vue from 'vue'
import VueRouter from 'vue-router'
import routes from './routes'
import Vuetify from 'vuetify';
import 'vuetify/dist/vuetify.min.css'

/*

import '@mdi/font/css/materialdesignicons.css' // Ensure you are using css-
import 'font-awesome/css/font-awesome.min.css'
import 'material-icons/iconfont/material-icons.scss';

*/

import Vuex from 'vuex'

Vue.use(Vuex);
Vue.use(VueRouter);
Vue.use(Vuetify);

Vue.component('top-bar',  require('../js/components/NavBar.vue').default )
Vue.component('bottom-bar',  require('../js/components/bottom_navbar.vue').default )

let app = new Vue({

    el: '#app',
    router: new VueRouter(routes),
    vuetify : new Vuetify(),
//    iconfont: ['mdi','mdiSvg', 'fa4'],


});
