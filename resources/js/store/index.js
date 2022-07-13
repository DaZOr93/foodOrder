import Vue from "vue";
import Vuex from 'vuex'
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
    },
    getters: {
        stateOrders: state => state.orders,
        stateShowOrder: state => state.showOrder,
        stateBasket: state => state.basket,
        stateTotalCostBasket: state => state.totalCostBasket,
        stateAddress: state => state.address,
        stateNotification: state => state.notification,
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
        }

    },
    actions: {
        addNotification({commit}, message){
            let timeStamp = Date.now().toLocaleString();
            let data = {name: message, icon: 'check_circle', id: timeStamp};
            commit('addNotification', data)
        },
        addNotificationError({commit}, message){
            let timeStamp = Date.now().toLocaleString();
            let data = {name: message, icon: 'error', id: timeStamp};
            commit('addNotification', data)

        },
        loadOrders({commit}) {
            return axiosInstance.get('/api/order')
                .then(res => {
                    commit('setOrders', res.data)
                })
        },
        loadShowOrder({commit}, id) {
            return axiosInstance.get('/api/order/'+id)
                .then(res => {
                    commit('setShowOrder', res.data)
                })
        },
        addItemToBasket(  {commit}, data) {
            return axiosInstance.post('/api/basket/'+data.id, data)
                .then((resp) => {
                    console.log('добавление')
                })
        },
        loadBasket({commit}) {
            return axiosInstance.get('/api/basket')
                .then(res => {
                    commit('setBasket', res.data)
                   let setTotalCostBasket = res.data.reduce((acc, item) => acc + item.menu.price*item.quantity , 0 )
                    commit('setTotalCostBasket', setTotalCostBasket)
                })

        },
        loadAddress({commit}) {
            return axiosInstance.get('/api/address')
                .then(res => {
                    commit('setAddress', res.data)
                })
        },
        addOrder(  {commit}, data) {
            return axiosInstance.post('/api/order/', data)
                .then((resp) => {
                    console.log('добавление')
                })
        },


    },
    modules: {

    }

})
