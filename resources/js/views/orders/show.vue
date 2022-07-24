<template>
    <div class="container">
        <div class="jumbotron">
            <h2 class="display-4">Заказ № {{id}}</h2>
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
            <p v-if="stateUser['role_id'] === 3">Статус заказа {{ stateShowOrder.status }}</p>
            <div class="d-flex align-items-center w-25" v-else>
                <label for="status">Статус: </label>
                <select @change="editStatus($event, stateShowOrder.id)" class="form-control" id="status" v-model="stateShowOrder.status"
                        name="status">
                    <option
                        v-for="(status, index) of $options.statusOption"
                        :key="index"
                        :value="status.value"
                    >
                        {{ status.name }}
                    </option>
                </select>
            </div>
            <table class="table table-striped">
                <tbody>
                <tr>
                    <td>Имя:</td>
<!--                    выдает ошибку что переменная name не может быть прочитана-->
                    <td v-if="stateShowOrder.user">{{ stateShowOrder.user.name }}</td>
                </tr>
                <tr>
                    <td>Телефон:</td>
                    <td>{{stateShowOrder.phone}}</td>
                </tr>
                <tr>
                    <td>Адрес:</td>
                    <td>{{stateShowOrder.address}}</td>
                </tr>
                </tbody>
            </table>


        </div>
    </div>
</template>

<script>
import {mapGetters, mapActions} from 'vuex';
import updateStatus from "../../mixin/updateStatus";
import getFormattedDateMixin from "../../mixin/getFormattedDate";
export default {
    mixins: [getFormattedDateMixin,updateStatus],
    name: "show",
    props: {
        id: Number,
    },
    mounted() {
        this.loadShowOrder(this.id)
    },
    methods: {
        ...mapActions(["loadShowOrder", "updateStatusOrder"]),
    },
    computed: {
        ...mapGetters(['stateShowOrder','stateUser'])
    }
}
</script>

<style scoped>

</style>
