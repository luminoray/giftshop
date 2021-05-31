import ItemCreateForm from "./components/items/ItemForm";

require('./bootstrap');

import Vue from 'vue';
import VueRouter from 'vue-router';
import VueCookie from 'vue-cookie';

Vue.use(VueRouter);
Vue.use(VueCookie);

import NavigationBar from "./components/common/NavigationBar";

import routes from "./routes";

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
