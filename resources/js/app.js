require('./bootstrap');
window.Vue = require('vue');

import Vue from 'vue';
import VueRouter from 'vue-router'
import routes from './routes'
import Vuetify from 'vuetify';
import 'vuetify/dist/vuetify.min.css'
import '@mdi/font/css/materialdesignicons.css' // Ensure you are using css-
import 'font-awesome/css/font-awesome.min.css'
import 'material-icons/iconfont/material-icons.scss';
import Vuex from 'vuex'
import Vueditor from 'vueditor'
import 'vueditor/dist/style/vueditor.min.css'


let config = {
  toolbar: [
   'removeFormat', 'undo', '|', 'elements', 'fontName', 'fontSize', 'foreColor', 'backColor', 'divider',
    'bold', 'italic', 'underline', 'strikeThrough', 'links', 'divider', 'subscript', 'superscript',
    'divider', 'justifyLeft', 'justifyCenter', 'justifyRight', 'justifyFull', '|', 'indent', 'outdent',
    'insertOrderedList', 'insertUnorderedList', '|', /*'picture',*/ 'tables', '|', 'switchView'
  ],
  fontName: [
    {val: 'arial black'},
    {val: 'times new roman'},
    {val: 'Courier New'}
  ],
  fontSize: ['12px', '14px', '16px', '18px', '0.8rem', '1.0rem', '1.2rem', '1.5rem', '2.0rem'],
  uploadUrl: ''
};

Vue.use(Vuex);
Vue.use(Vueditor, config);
Vue.use(VueRouter);
Vue.use(Vuetify);

let app = new Vue({

    el: '#app',
    router: new VueRouter(routes),
    vuetify : new Vuetify(),
    iconfont: ['mdi','mdiSvg', 'fa4']

});
