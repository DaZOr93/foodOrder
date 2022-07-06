<template>
    <div class="container">
        <div class="jumbotron">
            <h2 class="display-4">Мой заказ № {{id}}</h2>
            <p class="lead">Здесь вы можете, посмотреть свой заказ.</p>

            <table class="table table-striped">
                <thead>
                <tr>
                    <th scope="col">№</th>
                    <th scope="col">Название товара</th>
                    <th scope="col">Цена за 1</th>
                    <th scope="col">Количество</th>
                    <th scope="col">Всего</th>
                </tr>
                </thead>
                <tbody>


                <tr v-for="(menu, index) in stateShowOrder.menu">
                    <th scope="row"> {{index}} </th>
                    <td> {{menu.pivot.name}} </td>
                    <td> {{menu.pivot.price}} </td>
                    <td>{{menu.pivot.quantity}} </td>
                    <td> {{menu.pivot.total_cost}} </td>
                </tr>

                </tbody>
                <tfoot>
                <tr>
                    <td colspan="4">Всего</td>
                    <td colspan="2">{{stateShowOrder.order_price}} грн</td>
                </tr>
                </tfoot>
            </table>
            <p class="lead">Статус заказа: {{stateShowOrder.status}} </p>
            <p class="lead">Адрес</p>
            <table class="table table-striped">
                <tbody>
                <tr>
                    <td>{{stateShowOrder.address}}</td>
                </tr>
                </tbody>
            </table>


        </div>
    </div>
</template>

<script>
import {mapGetters, mapMutations, mapActions} from 'vuex';

export default {
    name: "show",
    props: {
        id: String,
    },
    mounted() {
        this.loadShowOrder(this.id)
    },
    methods: {
        ...mapActions(["loadShowOrder"]),
    },
    computed: {
        ...mapGetters(['stateShowOrder'])
    }
}
</script>

<style scoped>

</style>
