import vueRouter from 'vue-router';
import Vue from 'vue';

Vue.use(vueRouter);

import index from './views/index'
import orders from './views/orders/index'
import showOrder from './views/orders/show'
import basket from "./views/basket";
import login from "./views/login";
import registration from "./views/registration";





const router = new vueRouter({
    mode: "history",
    routes : [
        {
            path: '/',
            name: 'index',
            component : index
        },
        {
            path: '/orders',
            component: orders,
            name : 'orders'
        },
        {
            path: '/order/:id',
            name: 'orderShow',
            component: showOrder,
            props: true
        },
        {
            path: '/basket',
            component: basket,
            name: 'basket'
        },
        {
            path: '/login',
            component: login,
            name: 'login'
        },
        {
            path: '/registration',
            component: registration,
            name: 'registration'

        }
    ]
});

router.beforeEach((to, from, next) => {
    const token = localStorage.getItem('x_xsrf_token')

    if (!token){
        if (to.name === 'login'|| to.name === 'registration' || to.name === 'index') {
            return next()
        } else next({
            name: 'login'
        })
    }
    if (to.name === 'login'|| to.name === 'registration') {
        return next({
            name: 'index'
        }
    )
    }
    next()
})

export default router
