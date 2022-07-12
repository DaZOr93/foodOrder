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
    },
    getters: {
        stateOrders: state => state.orders,
        stateShowOrder: state => state.showOrder,
        stateBasket: state => state.basket,
        stateTotalCostBasket: state => state.totalCostBasket
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
        }

    },
    actions: {
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


    },
    modules: {

    }

})
