<template>
    <div class="container">
        <v-popup
            v-if="popupVisibleAddress"
            rightBtnTitle="Добавить адресс"

            @closePopup="closePopup"

        ></v-popup>
        <div class="jumbotron">
            <h2 class="display-4">Корзина</h2>
            <p class="lead">Здесь вы можете, редактировать корзину или и оформить заказ.</p>

                <table v-if="Object.keys(stateBasket).length !== 0" class="table table-striped">
                <thead>
                <tr>
                    <th scope="col">№</th>
                    <th scope="col">Название товара</th>
                    <th scope="col">Цена за 1</th>
                    <th scope="col">Количество</th>
                    <th scope="col">Всего</th>
                    <th colspan="2" scope="col">Действия</th>
                </tr>
                </thead>
                <tbody>

                <basket-item-component v-for="(basket_item, index) in stateBasket"
                    :index = index
                    :name = basket_item.menu.name
                    :price = +basket_item.menu.price
                    :quantity = +basket_item.quantity
                    :key = index
                    :menuId = basket_item.menu.id

                >
                </basket-item-component>
                </tbody>
                <tfoot>
                <tr>
                    <td colspan="4">Всего</td>
                    <td colspan="2">{{stateTotalCostBasket}} грн</td>
                </tr>
                </tfoot>
            </table>
           <div  v-else>
               <hr>
               <h4>Товаров нет, добавьте что то</h4>
               <hr>
           </div>

            <p class="lead">Адрес</p>
            <table v-if="Object.keys(stateAddress).length !== 0" class="table table-striped">
                <tbody>
                    <tr v-for="(address_item, index) in stateAddress">
                        <th scope="row"> {{index+1}} </th>
                        <td>
                            <input type="radio" name="address_id" :value="address_item.id" v-model="selectAddress">
                        </td>
                        <td class="d-flex" >
                            <div>{{address_item.city}}, {{ address_item.street}} {{address_item.house}}</div>
                            <div v-if="address_item.apartment">{{'-'+address_item.apartment}}</div>
                        </td>
                    </tr>
                </tbody>
            </table>
            <div  v-else>
                <hr>
                <h4>Адресов нет, добавьте что то</h4>

            </div>

            <button v-on:click="showPopup()" class="btn btn-primary btn-sm"  role="button">Добавить адрес</button>
            <hr>

            <button v-on:click="orderComplete()" class="btn btn-primary btn-lg"  type="button">Оформить заказ</button>



        </div>
    </div>
</template>

<script>
import {mapGetters, mapMutations, mapActions} from 'vuex';
import BasketItemComponent from "../components/BasketItemComponent";

export default {
    name: "basket",
    components: {BasketItemComponent},
    data() {
        return{
            basketCost: 12,
            selectAddress: '',
            popupVisibleAddress: false,
        }
    },
    methods: {
        ...mapActions(["loadBasket", "loadAddress", "addOrder"]),
        orderComplete(){
            this.addOrder({
                address_id: this.selectAddress,
            })
        },
        closePopup(){
            this.popupVisibleAddress = false
        },
        showPopup(){
            this.popupVisibleAddress = true
        },
    },
    mounted() {
        this.loadBasket()
        this.loadAddress()
    },
    computed: {
        ...mapGetters(['stateBasket', 'stateTotalCostBasket' , 'stateAddress']),

    }
}
</script>

<style scoped>

</style>
