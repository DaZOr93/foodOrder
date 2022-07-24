import vueRouter from 'vue-router';
import Vue from 'vue';

Vue.use(vueRouter);

import index from './views/index'
import orders from './views/orders/index'
import showOrder from './views/orders/show'
import basket from "./views/basket";
import login from "./views/login";
import registration from "./views/registration";
import profile from "./views/profile";
import menuItemEdit from "./views/dashboard/menuItemEdit";
import menuItemAdd from "./views/dashboard/menuItemAdd";
import categories from "./views/dashboard/categories";
import categoryEdit from "./views/dashboard/categoryEdit";
import categoryAdd from "./views/dashboard/categoryAdd";
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
            props: (route) => ({ id: Number(route.params.id) })
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

        },
        {
            path: '/profile',
            component: profile,
            name: 'profile'

        },
        {
            path: '/dashboard/menu/edit/:id',
            name: 'menuItemEdit',
            component: menuItemEdit,
            props: (route) => ({ id: Number(route.params.id) })
        },
        {
            path: '/dashboard/menu/add',
            name: 'menuItemAdd',
            component: menuItemAdd,

        },
        {
            path: '/dashboard/categories',
            name: 'categories',
            component: categories,

        },
        {
          path: '/dashboard/category/edit/:id',
          name: 'categoryEdit',
          component: categoryEdit,
            props: (route) => ({ id: Number(route.params.id) })
        },
        {
            path: '/dashboard/category/add',
            name: 'categoryAdd',
            component: categoryAdd,

        },
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
