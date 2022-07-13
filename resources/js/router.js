import vueRouter from 'vue-router';
import Vue from 'vue';

Vue.use(vueRouter);

import index from './views/index'
import orders from './views/orders/index'
import showOrder from './views/orders/show'
import basket from "./views/basket";
import login from "./views/login";
import registration from "./views/registration";



const routes = [
    {
        path: '/',
        name: 'index',
        component : index
    },
    {
        path: '/orders',
        component: orders
    },
    {
        path: '/order/:id',
        name: 'orderShow',
        component: showOrder,
        props: true
    },
    {
        path: '/basket',
        component: basket
    },
    {
        path: '/login',
        component: login
    },
    {
        path: '/registration',
        component: registration
    }
];

export default new vueRouter({
    mode: "history",
    routes
});
