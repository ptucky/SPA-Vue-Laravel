require('./bootstrap');
//window.Vue = require('vue');

import Vue from 'vue';
import VueRouter from 'vue-router';
import Vuex from 'vuex';
import StoreDataAll from './store';
import MainApp from './components/MainApp.vue';
import Toastr from "vue-toastr";

import {routes} from './routes';
import { initialize } from './helpers/initialize'

Vue.use(VueRouter);
Vue.use(Vuex);
Vue.use(Toastr);

const store = new Vuex.Store(StoreDataAll);

const router = new VueRouter({
    routes,
    mode: 'history'
});

initialize(store, router);

const app = new Vue({
    el: '#app',
    router,
    store,
    components: {
        MainApp
    }
});
