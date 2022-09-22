import Vue from 'vue';
import VueRouter from 'vue-router';
import Home from './Home.vue';
import Login from './Login.vue';
import Register from './Register';

Vue.use(VueRouter);

export const routes =  [

    {
        path:"/",
        name:"Home",
        component: Home
    },

    {
        path:"/login",
        name:"Login",
        component: Login
    }

 
]