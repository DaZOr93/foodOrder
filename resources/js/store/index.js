import Vue from "vue";
import Vuex from 'vuex'
import router from "../router";
import {axiosInstance} from "../service/api";
import axios from "axios";


Vue.use(Vuex)

export default new Vuex.Store({
    state: {
        orders: [],
        showOrder: [],
        basket: [],
        totalCostBasket: 0,
        address: [],
        notification: [],
        token: null,
        profile: [],
        user: [],
        menuItem: {},
        categoryItem: {},
        categories: [],
        menu: {},
    },
    getters: {
        stateOrders: state => state.orders,
        stateShowOrder: state => state.showOrder,
        stateBasket: state => state.basket,
        stateTotalCostBasket: state => state.totalCostBasket,
        stateAddress: state => state.address,
        stateNotification: state => state.notification,
        stateToken: state => state.token,
        stateProfile: state => state.profile,
        stateUser: state => state.user,
        stateMenuItem: state => state.menuItem,
        stateCategories: state => state.categories,
        stateCategoryItem: state => state.categoryItem,
        stateMenu: state => state.menu,
    },
    mutations: {
        setOrders(state, orders) {
            state.orders = orders;
        },
        setShowOrder(state, showOrder) {
            state.showOrder = showOrder;
        },
        setBasket(state, basket) {
            state.basket = basket;
        },
        setTotalCostBasket(state, totalCostBasket) {
            state.totalCostBasket = totalCostBasket;
        },
        setAddress(state, address) {
            state.address = address;
        },
        addNotification(state, data) {
            state.notification.unshift(data);
        },
        deleteNotification(state) {
            state.notification.splice(state.notification.length - 1, 1)
        },
        setToken(state) {
            state.token = localStorage.getItem('x_xsrf_token')
        },
        setProfile(state, profile) {
            state.profile = profile
        },
        setUser(state, user) {
            state.user = user
        },
        setMenuItem(state, menuItem) {
            state.menuItem = menuItem
        },
        setCategories(state, categories) {
            state.categories = categories
        },
        setCategoryItem(state, categoryItem) {
            state.categoryItem = categoryItem
        },
        setMenu(state, menu) {
            state.menu = menu
        },

    },
    actions: {
        loadMenu({commit}) {
            return axios.get('/api/menu')
                .then(res => {
                    commit('setMenu', res.data);
                })
        },
        loadCategories({commit}) {
            return axios.get('/api/category')
                .then(res => {
                    commit('setCategories', res.data);
                })
        },
        deleteBasketItem({dispatch}, id) {
            if (confirm("Удалить позицию")) {
                return axiosInstance.delete('/api/basket/' + id)
                    .then((resp) => {
                        dispatch('addNotification', 'Позиция удалена')
                        dispatch('loadBasket')
                        return resp
                    })
            }
        },
        loadAddress({commit, dispatch}) {
            return axiosInstance.get('/api/address')
                .then(res => {
                    commit('setAddress', res.data)
                })
                .catch(err => {
                    dispatch('unauthorized', err)
                })
        },
        deleteAddress({dispatch}, id) {
            if (confirm("Удалить адрес")) {
                return axiosInstance.delete('/api/address/' + id)
                    .then((resp) => {
                        dispatch('addNotification', 'Адрес удален')
                        dispatch('loadAddress')
                        return resp
                    })
            }
        },
        addAddressActions({dispatch}, data) {
            return axiosInstance.post('/api/address/', data)
                .then((resp) => {
                    dispatch('addNotification', 'Адрес добавлен')
                    return resp
                })
                .catch(err => {
                    let errors = err.response.data.errors
                    for (let key in errors) {
                        dispatch('addNotificationError', errors[key][0])
                    }
                    return err.response
                })
        },
        updateAddressActions({dispatch}, data) {
            return axiosInstance.put('/api/address/' + data.id, data)
                .then((resp) => {
                    dispatch('addNotification', 'Адрес обновлен')
                    return resp
                })
                .catch(err => {
                    let errors = err.response.data.errors
                    for (let key in errors) {
                        dispatch('addNotificationError', errors[key][0])
                    }
                    return err.response
                })
        },
        readUser({commit, dispatch, getters}) {
            if (getters.stateToken) {
                return axiosInstance.get('/api/profile')
                    .then(res => {
                        commit('setUser', res.data)

                    })
                    .catch(err => {

                    })
            } else {
                commit('setUser', [])
            }
        },

        readToken({commit}) {
            commit('setToken')
        },
        unauthorized({dispatch}, err) {
            if (err.response.status === 401) {
                localStorage.removeItem('x_xsrf_token')
                dispatch('readToken')
                router.push({name: 'login'})
            }
        },

        addNotification({commit}, message) {
            let data = {name: message, icon: 'check_circle', id: Math.random() * Date.now()};
            commit('addNotification', data)
        },
        addNotificationError({commit}, message) {

            let data = {name: message, icon: 'error', id: Math.random() * Date.now()};
            commit('addNotification', data)
            return 200;

        },
        loadOrders({commit, dispatch}) {
            return axiosInstance.get('/api/order')
                .then(res => {
                    commit('setOrders', res.data)
                })
                .catch(err => {
                    dispatch('unauthorized', err)
                })
        },
        loadProfile({commit, dispatch}) {
            return axiosInstance.get('/api/profile')
                .then(res => {
                    commit('setProfile', res.data)
                    return res
                })
                .catch(err => {
                    dispatch('unauthorized', err)
                })
        },
        updateProfile({dispatch}, data) {
            return axiosInstance.put('/api/profile/', data)
                .then((resp) => {
                    dispatch('addNotification', 'Профиль обновлен')

                }).catch(err => {
                    dispatch('unauthorized', err)
                    let errors = err.response.data.errors
                    for (let key in errors) {
                        dispatch('addNotificationError', errors[key][0])
                    }
                })
        },
        loadShowOrder({commit, dispatch}, id) {
            return axiosInstance.get('/api/order/' + id)
                .then(res => {
                    commit('setShowOrder', res.data)
                })
                .catch(err => {
                    dispatch('unauthorized', err)
                })
        },
        addItemToBasket({dispatch}, data) {
            return axiosInstance.post('/api/basket/' + data.id, data)
                .then((resp) => {
                    dispatch('addNotification', 'Добавленно')
                    dispatch("loadBasket")
                }).catch(err => {
                    dispatch('unauthorized', err)
                    let errors = err.response.data.errors
                    for (let key in errors) {
                        dispatch('addNotificationError', errors[key][0])
                    }
                })
        },
        loadBasket({commit, dispatch}) {
            return axiosInstance.get('/api/basket')
                .then(res => {
                    commit('setBasket', res.data)
                    let setTotalCostBasket = res.data.reduce((acc, item) => acc + item.menu.price * item.quantity, 0)
                    commit('setTotalCostBasket', setTotalCostBasket)
                })
                .catch(err => {
                    dispatch('unauthorized', err)
                })

        },
        addOrder({commit, dispatch}, data) {
            return axiosInstance.post('/api/order/', data)
                .then((resp) => {
                    dispatch('addNotification', 'Заказ добавлен')
                    router.push({name: 'orderShow', params: {id: resp.data}})
                })
                .catch(err => {
                    dispatch('unauthorized', err)
                    let errors = err.response.data.errors
                    for (let key in errors) {
                        dispatch('addNotificationError', errors[key][0])
                    }
                })
        },
        loadMenuItem({commit, dispatch}, id) {
            return axiosInstance.get('/api/menu/' + id)
                .then(res => {
                    commit('setMenuItem', res.data)
                })
                .catch(err => {
                    dispatch('unauthorized', err)
                })
        },
        updateMenuItem({dispatch}, data) {
            return axiosInstance.post('/api/menu/update/' + data.get('id'), data)
                .then((resp) => {
                    dispatch('addNotification', 'Позиция меню обновлена');
                    dispatch('loadMenuItem', data.get('id'))

                    return resp
                })
                .catch(err => {
                    let errors = err.response.data.errors
                    for (let key in errors) {
                        dispatch('addNotificationError', errors[key][0])
                    }
                    return err.response
                })
        },
        addMenuItem({dispatch}, data) {
            return axiosInstance.post('/api/menu/add/', data)
                .then((resp) => {
                    dispatch('addNotification', 'Позиция меню добавлена');
                    return resp
                })
                .catch(err => {
                    let errors = err.response.data.errors
                    for (let key in errors) {
                        dispatch('addNotificationError', errors[key][0])
                    }
                    return err.response
                })
        },
        deleteMenuItem({dispatch}, id) {
            if (confirm("Удалить позицию меню")) {
                return axiosInstance.delete('/api/menu/' + id)
                    .then((resp) => {
                        dispatch('addNotification', 'Позиция меню удален')
                        dispatch('loadMenu')
                        return resp
                    })
            }
        },
        loadCategoryItem({commit, dispatch}, id) {
            return axiosInstance.get('/api/category/' + id)
                .then(res => {
                    commit('setCategoryItem', res.data)
                })
                .catch(err => {
                    dispatch('unauthorized', err)
                })
        },
        updateCategoryItem({dispatch}, data) {
            return axiosInstance.post('/api/category/update/' + data.get('id'), data)
                .then((resp) => {
                    dispatch('addNotification', 'Категория обновлена');
                    dispatch('loadCategoryItem', data.get('id'))

                    return resp
                })
                .catch(err => {
                    let errors = err.response.data.errors
                    for (let key in errors) {
                        dispatch('addNotificationError', errors[key][0])
                    }
                    return err.response
                })
        },
        addCategoryItem({dispatch}, data) {
            return axiosInstance.post('/api/category/add/', data)
                .then((resp) => {
                    dispatch('addNotification', 'Категория добавлена');
                    return resp
                })
                .catch(err => {
                    let errors = err.response.data.errors
                    for (let key in errors) {
                        dispatch('addNotificationError', errors[key][0])
                    }
                    return err.response
                })
        },
        deleteCategoryItem({dispatch}, id) {
            if (confirm("Удалить позицию меню")) {
                return axiosInstance.delete('/api/category/' + id)
                    .then((resp) => {
                        dispatch('addNotification', 'Категория удален')
                        dispatch('loadCategories')
                        return resp
                    })
            }
        },


    },
    modules: {}

})
