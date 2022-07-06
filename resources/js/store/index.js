import Vue from "vue";
import Vuex from 'vuex'
import axios from "axios";
import {commit} from "lodash/seq";
import moment from 'moment';

Vue.use(Vuex)

export default new Vuex.Store({
    state: {
        orders: [],
        showOrder: [],
    },
    getters: {
        stateOrders: state => state.orders,
        stateShowOrder: state => state.showOrder
    },
    mutations: {
        setOrders(state, orders) {
            state.orders = orders;
        },
        serShowOrder(state, showOrder) {
            state.showOrder = showOrder;
        }
    },
    actions: {
        loadOrders({commit}) {
            axios.get('/api/order')
                .then(res => {
                    commit('setOrders', res.data)
                })
        },
        loadShowOrder({commit}, id) {
            axios.get('/api/order/'+id)
                .then(res => {
                    commit('serShowOrder', res.data)
                })
        },
        getFormattedDate(date) {
            console.log(date);
            return moment(date).format("DD-MM-YYYY")
        }


    },
    modules: {

    }

})
