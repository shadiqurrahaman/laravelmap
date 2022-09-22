
require('./bootstrap');
import Vue from 'vue';
import Home from './app/Home';
import { routes } from './app/routes';
import VueRouter from 'vue-router';

const router = new VueRouter({
    routes,
    mode : "history", 
});

const app = new Vue({
    el: '#app',
    router: routes,
    render: h =>h(Home),
});
