<template>
    <div>
        <div class="container">
            <div class="jumbotron">
                <h2 class="display-4">Мои закакзы</h2>
                <p class="lead">Здесь вы можете, посмотреть свои заказы.</p>

                <table class="table table-striped">
                    <thead>
                    <tr>
                        <th scope="col">№</th>
                        <th scope="col">№ заказа</th>
                        <th scope="col">Дата заказа</th>
                        <th scope="col">Сумма</th>
                        <th scope="col">Статус</th>
                    </tr>
                    </thead>
                    <tbody>

                    <tr v-for="(order, index) in stateOrders">
                        <th scope="row"> {{ index }}</th>
                        <td>
                            <router-link  :to="{ name: 'orderShow', params: { id: order.id } }">
                                {{ order.id }}
                            </router-link>
                        </td>
                        <td> {{ getFormattedDate(order.created_at) }}</td>
                        <td> {{ order.order_price }}</td>
                        <td>{{ order.status }}</td>
                    </tr>
                    </tbody>
                </table>
            </div>

        </div>
        <div class="justify-content-center"></div>
    </div>

</template>

<script>
import axios from "axios";
import {mapGetters, mapMutations, mapActions} from 'vuex';
import moment from 'moment';

export default {
    name: "orders",
    data: () => ({

    }),
    mounted() {
        this.loadOrders()
    },
    methods: {
        ...mapActions(["loadOrders"]),
        getFormattedDate(date) {
            return moment(date).format("DD-MM-YYYY hh:mm:ss")
        }

    },
    computed: {
        ...mapGetters(['stateOrders'])
    }
}
</script>

<style scoped>

</style>
