require('./bootstrap');

import Vue from 'vue';
import VueRouter from 'vue-router';

Vue.use(VueRouter);

import NavigationBar from "./components/common/NavigationBar";
import ItemList from "./components/items/ItemList";
import LoginForm from './components/users/LoginForm';
import RegisterForm from "./components/users/RegisterForm";

const routes = [
    {path: '/', name:'home', component: ItemList},
    {path: '/login', name: 'login', component: LoginForm},
    {path: '/register', name: 'register', component: RegisterForm}
];

const router = new VueRouter({
    mode: 'history',
    routes
});

const app = new Vue({
    el: '#app',
    components: {
        NavigationBar
    },
    router
});
