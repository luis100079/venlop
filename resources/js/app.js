require('./bootstrap');

import Vue from 'vue';
import VueRouter from 'vue-router'
import routes from './routes'
import Vuetify from 'vuetify';
import 'vuetify/dist/vuetify.min.css'

Vue.use(VueRouter);
Vue.use(Vuetify);

let  app = new Vue({

    el: '#app',

    router: new VueRouter(routes),
    vuetify : new Vuetify(),

});
