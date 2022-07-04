import vueRouter from 'vue-router';
import Vue from 'vue';

Vue.use(vueRouter);

import index from './views/index'

const routes = [
    {
        path: '/',
        component : index
    }
];

export default new vueRouter({
    mode: "history",
    routes
});
