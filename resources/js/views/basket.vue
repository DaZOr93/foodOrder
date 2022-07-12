<template>
    <div class="container">
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
            <table class="table table-striped">
                <tbody>


                    <tr>
                        <th scope="row"> $loop->iteration}} </th>
                        <td>
                            <input type="radio" name="address_id" value="$address_item->id}}">
                        </td>
                        <td> address_item->city}}, $address_item->street}} $address_item->house}}
                            isset($address_item->apartment))
                            - '.$address_item->apartment}}

                        </td>
                    </tr>
<!--                    @empty-->
                    <a class="btn btn-primary btn-lg"  role="button">Добавить адрес</a>
<!--                    @endforelse-->
                </tbody>
            </table>

            <div class="text-red-600 mb-4">Выберите адрес</div>


<!--            @if(!$address->isEmpty())-->
            <button class="btn btn-primary btn-lg"  type="submit">Оформить заказ</button>



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
        }
    },
    methods: {
        ...mapActions(["loadBasket"]),

    },
    mounted() {
        this.loadBasket()
        this.totalCost()
    },
    computed: {
        ...mapGetters(['stateBasket', 'stateTotalCostBasket']),

    }
}
</script>

<style scoped>

</style>
