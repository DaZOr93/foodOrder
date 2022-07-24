<template>
    <div>
        <div class="container">
            <div class="jumbotron">
                <div v-if="stateUser['role_id'] === 3">
                    <h2 class="display-4">Мои закакзы</h2>
                    <p class="lead">Здесь вы можете, посмотреть свои заказы.</p>
                </div>
                <div v-else>
                    <h2 class="display-4">Все закакзы</h2>
                    <p class="lead">Здесь вы можете, управлять заказами.</p>
                </div>


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

                    <tr v-for="(order, index) in stateOrders.data">
                        <th scope="row"> {{ index+1 }}</th>
                        <td>
                            <router-link  :to="{ name: 'orderShow', params: { id: order.id } }">
                                {{ order.id }}
                            </router-link>
                        </td>
                        <td> {{ getFormattedDate(order.created_at) }}</td>
                        <td> {{ order.order_price }}</td>
                        <td v-if="stateUser['role_id'] === 3">{{ order.status }}</td>
                        <td v-else>
                            <select @change="editStatus($event, order.id)" class="form-control" id="status" v-model="order.status"
                                    name="status">
                                <option
                                    v-for="(status, index) of $options.statusOption"
                                    :key="index"
                                    :value="status.value"
                                >
                                    {{ status.name }}
                                </option>
                            </select>
                        </td>
                    </tr>
                    </tbody>
                </table>
            </div>

        </div>
        <div class="justify-content-center">
            <pagination  :data="stateOrders"  @pagination-change-page="loadOrders">
                <span slot="prev-nav">&lt; Предыдущая</span>

                <span slot="next-nav">Следущая &gt;</span>
            </pagination>
        </div>
    </div>

</template>

<script>

import {mapGetters, mapActions} from 'vuex';
import updateStatus from "../../mixin/updateStatus";
import getFormattedDateMixin from "../../mixin/getFormattedDate";

export default {
    mixins: [getFormattedDateMixin,updateStatus],
    name: "orders",
    data: () => ({

    }),
    mounted() {
        this.loadOrders()
    },
    methods: {
        ...mapActions(["loadOrders", "readUser", "updateStatusOrder"]),
    },
    computed: {
        ...mapGetters(['stateOrders','stateUser'])
    }
}
</script>

<style scoped>

</style>
