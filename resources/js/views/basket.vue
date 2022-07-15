<template>
    <div class="container">
        <v-popup
            v-if="popupVisibleAddress"
            rightBtnTitle="Добавить адрес"
            popupTitle="Добавить адрес"
            @closePopup="closePopup"
            @rightBtnAction="addAddress"
        >
            <address-editor
                :apartment = apartment
                :city = city
                :house = house
                :street = street
                @handlerAddress = updateAddress
            ></address-editor>
<!--            <div class="row gutters mb-3">
                <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                    <div class="form-group">
                        <label for="city">Город</label>
                        <input type="text" class="form-control" name="city" placeholder="Введите город"
                               v-model="city">
                    </div>
                </div>
                <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                    <div class="form-group">
                        <label for="street">Улица</label>
                        <input type="text" class="form-control" name="street" placeholder="Введите улицу"
                               v-model="street">
                    </div>
                </div>
                <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                    <div class="form-group">
                        <label for="house">Дом</label>
                        <input type="text" class="form-control" name="house" placeholder="Введите номер дома"
                               v-model="house">
                    </div>
                </div>
                <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                    <div class="form-group">
                        <label for="apartment">Квартира</label>
                        <input type="text" class="form-control" name="apartment" placeholder="Введите номер квартиры"
                               v-model="apartment">
                    </div>
                </div>
            </div>-->
        </v-popup>
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
                                       :index=index
                                       :name=basket_item.menu.name
                                       :price=+basket_item.menu.price
                                       :quantity=+basket_item.quantity
                                       :key=index
                                       :menuId=basket_item.menu.id

                >
                </basket-item-component>
                </tbody>
                <tfoot>
                <tr>
                    <td colspan="4">Всего</td>
                    <td colspan="2">{{ stateTotalCostBasket }} грн</td>
                </tr>
                </tfoot>
            </table>
            <div v-else>
                <hr>
                <h4>Товаров нет, добавьте что то</h4>
                <hr>
            </div>

            <p class="lead">Адрес</p>
            <table v-if="Object.keys(stateAddress).length !== 0" class="table table-striped">
                <tbody>
                <address-component v-for="(address_item, index) in stateAddress"
                                   :index = index
                                   :apartment = address_item.apartment
                                   :city = address_item.city
                                   :house = address_item.house
                                   :id = address_item.id
                                   :key = address_item.id
                                   :street = address_item.street
                                   @select = "selectAddress"
                ></address-component>
                </tbody>
            </table>
            <div v-else>
                <hr>
                <h4>Адресов нет, добавьте что то</h4>

            </div>

            <button v-on:click="showPopup()" class="btn btn-primary btn-sm" role="button">Добавить адрес</button>
            <hr>

            <button v-if="Object.keys(stateBasket).length !== 0" v-on:click="orderComplete()" class="btn btn-primary btn-lg" type="button">Оформить заказ</button>


        </div>
    </div>
</template>

<script>
import {mapGetters, mapMutations, mapActions} from 'vuex';
import BasketItemComponent from "../components/BasketItemComponent";
import AddressComponent from "../components/AddressComponent";
import AddressEditor from "../components/AddressEditor";
export default {
    name: "basket",
    components: {AddressComponent, BasketItemComponent, AddressEditor},
    data() {
        return {
            address_id: '',
            popupVisibleAddress: false,
            city: '',
            street: '',
            house: '',
            apartment: '',
        }
    },
    methods: {
        ...mapActions(["loadBasket", "loadAddress", "addOrder","addAddressActions"]),
        updateAddress(data){
            this.city = data.city;
            this.street = data.street;
            this.house = data.house;
            this.apartment = data.apartment;
        },
        selectAddress(data){
           this.address_id = data
        },
        orderComplete() {
            this.addOrder({
                address_id: this.address_id,
            })
        },
        clearForm(){
            this.city = '';
            this.street = '';
            this.house = '';
            this.apartment = '';
        },
        closePopup() {
            this.popupVisibleAddress = false;
            this.clearForm();
        },
        showPopup() {
            this.popupVisibleAddress = true
        },
        addAddress() {
            this.addAddressActions({
                city: this.city,
                street: this.street,
                house: this.house,
                apartment: this.apartment
            }).then((resp)=>{
                if(resp.status === 200){
                    this.clearForm()
                    this.closePopup();
                    this.loadAddress()
                }
            })


        }
    },
    mounted() {
        this.loadBasket()
        this.loadAddress()
    },
    computed: {
        ...mapGetters(['stateBasket', 'stateTotalCostBasket', 'stateAddress']),

    }
}
</script>

<style scoped>

</style>
