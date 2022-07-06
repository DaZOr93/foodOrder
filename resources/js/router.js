import vueRouter from 'vue-router';
import Vue from 'vue';

Vue.use(vueRouter);

import index from './views/index'
import orders from './views/orders/index'
import showOrder from './views/orders/show'


const routes = [
    {
        path: '/',
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
    }
];

export default new vueRouter({
    mode: "history",
    routes
});
