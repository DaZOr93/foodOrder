<template>
        <tr>
            <th> {{ index + 1 }}</th>
            <td>
                <input type="radio" name="address_id" :value="id" v-on:click="selectAddress">
            </td>
            <td>
                <span>г. {{ city }}, ул. {{ street }} д. {{ house }}</span>
                <span v-if="apartment">кв. {{apartment }}</span>
            </td>
            <td>
                <button v-on:click="showPopup()" class="btn btn-primary btn-sm" role="button">Редактировать</button>
            </td>
            <td>
                <button v-on:click="deleteAddres(id)" class="btn btn-danger btn-sm" type="button">Удалить</button>
            </td>
            <v-popup
                v-if="popupVisibleAddressEdit"
                rightBtnTitle="Обновить адрес"
                popupTitle="Редактировать адрес"
                @closePopup="closePopup"
                @rightBtnAction="updateAddress"
            >
                <address-editor
                    :apartment = apartment
                    :city = city
                    :house = house
                    :street = street
                    @handlerAddress = updateAddressData
                ></address-editor>
            </v-popup>
        </tr>
</template>

<script>
import {mapActions} from "vuex";
import AddressEditor from "../components/AddressEditor";
export default {
    name: "AddressComponent",
    components: {AddressEditor},
    data() {
        return{
            popupVisibleAddressEdit: false,
            newAddressData: {},
        }
    },
    props: {
        id: {
            type: Number
        },
        city: {
            type: String,
        },
        street: {
            type: String,
        },
        house: {
            type : String,
        },
        index: {
            type : Number,
        },
        apartment: {
            type: String,
        },
    },
    methods: {
        ...mapActions(['deleteAddress','updateAddressActions']),
        selectAddress(){
            this.$emit('select', this.id)
        },
        deleteAddres(){
            this.deleteAddress(this.id)
        },
        closePopup() {
            this.popupVisibleAddressEdit = false;
        },
        updateAddressData(data){
            this.newAddressData = data;
        },
        updateAddress(){
            this.updateAddressActions( {
                city: this.newAddressData.city,
                street: this.newAddressData.street,
                house: this.newAddressData.house,
                apartment: this.newAddressData.apartment
            })

        },
        showPopup() {
            this.popupVisibleAddressEdit = true
        },
    }
}
</script>

<style scoped>

</style>
