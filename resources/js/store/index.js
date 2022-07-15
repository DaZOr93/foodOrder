import Vue from "vue";
import Vuex from 'vuex'
import router from "../router";
import {axiosInstance} from "../service/api";



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
    },
    getters: {
        stateOrders: state => state.orders,
        stateShowOrder: state => state.showOrder,
        stateBasket: state => state.basket,
        stateTotalCostBasket: state => state.totalCostBasket,
        stateAddress: state => state.address,
        stateNotification: state => state.notification,
        stateToken: state => state.token,
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
        addNotification(state, data){
            state.notification.unshift(data);
        },
        deleteNotification(state){
            state.notification.splice(state.notification.length - 1, 1)
        },
        setToken(state) {
            state.token = localStorage.getItem('x_xsrf_token')
        }

    },
    actions: {
        deleteAddress({dispatch}, id){
            if(confirm("Удалить адрес")){
                return axiosInstance.delete('/api/address/'+id)
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
                .catch(err=>{
                    let errors = err.response.data.errors
                    for(let key in errors){
                        dispatch('addNotificationError',errors[key][0])
                    }
                    return err.response
                })
        },
        updateAddressActions({dispatch}, id, data) {
            return axiosInstance.put('/api/address/'+id, data)
                .then((resp) => {
                    dispatch('addNotification', 'Адрес обновлен')
                    return resp
                })
                .catch(err=>{
                    let errors = err.response.data.errors
                    for(let key in errors){
                        dispatch('addNotificationError',errors[key][0])
                    }
                    return err.response
                })
        },

        readToken({commit}){
            commit('setToken')
        },
        unauthorized({dispatch}, err){
            if(err.response.status === 401){
                localStorage.removeItem('x_xsrf_token')
                dispatch('readToken')
                router.push({name: 'login'})
            }
        },
        addNotification({commit}, message){
            function getRandomInt(min, max) {
                min = Math.ceil(min);
                max = Math.floor(max);
                return Math.floor(Math.random() * (max - min)) + min;
            }
            let timeStamp = getRandomInt(1,100) * Date.now().toLocaleString();
            let data = {name: message, icon: 'check_circle', id: timeStamp};
            commit('addNotification', data)
        },
        addNotificationError({commit}, message){
            function getRandomInt(min, max) {
                min = Math.ceil(min);
                max = Math.floor(max);
                return Math.floor(Math.random() * (max - min)) + min;
            }
            let timeStamp = getRandomInt(1,100)*Date.now();
            let data = {name: message, icon: 'error', id: timeStamp};
            commit('addNotification', data)
            return 200;

        },
        loadOrders({commit, dispatch}) {
            return axiosInstance.get('/api/order')
                .then(res => {
                    commit('setOrders', res.data)
                })
                .catch(err=>{
                    dispatch('unauthorized', err)
                })
        },
        loadShowOrder({commit, dispatch}, id) {
            return axiosInstance.get('/api/order/'+id)
                .then(res => {
                    commit('setShowOrder', res.data)
                })
                .catch(err=>{
                    dispatch('unauthorized', err)
                })
        },
        addItemToBasket(  {dispatch}, data) {
            return axiosInstance.post('/api/basket/'+data.id, data)
                .then((resp) => {
                    dispatch('addNotification', 'Добавленно')
                }).catch(err=>{
                    dispatch('unauthorized', err)
                })
        },
        loadBasket({commit, dispatch}) {
            return axiosInstance.get('/api/basket')
                .then(res => {
                    commit('setBasket', res.data)
                   let setTotalCostBasket = res.data.reduce((acc, item) => acc + item.menu.price*item.quantity , 0 )
                    commit('setTotalCostBasket', setTotalCostBasket)
                })
                .catch(err=>{
                    dispatch('unauthorized', err)
                })

        },
        loadAddress({commit, dispatch}) {
            return axiosInstance.get('/api/address')
                .then(res => {
                    commit('setAddress', res.data)
                })
                .catch(err=>{
                    dispatch('unauthorized', err)
                })
        },
        addOrder(  {commit, dispatch}, data) {
            return axiosInstance.post('/api/order/', data)
                .then((resp) => {
                    dispatch('addNotification', 'Заказ добавлен')
                    router.push({name: 'orderShow', params: { id: resp.data}})
                })
                .catch(err=>{
                    dispatch('unauthorized', err)
                    let errors = err.response.data.errors
                    for(let key in errors){
                        dispatch('addNotificationError',errors[key][0])
                    }
                })
        },


    },
    modules: {

    }

})
