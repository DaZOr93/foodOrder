<template>

        <tr>
            <th scope="row"> {{index+1}} </th>
            <td> {{name}} </td>
            <td> {{price}} </td>
            <td class="d-flex" >
                <input @blur="setCount" type="number" name="quantity" max="20" min="1"  v-model="count" class="form-control quantity" >
                <button type="button" v-on:click="addBasket(menuId)" class="btn btn-sm btn-outline-secondary">Ок</button>
            </td>
            <td> {{price*quantity}} </td>
            <td>
                <button v-on:click="deleteBasket" class="btn btn-danger btn-sm" type="button">Удалить</button>
            </td>

        </tr>

</template>

<script>
import { mapActions} from 'vuex';
export default {
    name: "BasketItemComponent",
    data() {
        return{
            count: 0,
        }
    },
    props: {
        name: {
            type: String,
        },
        quantity: {
            type : Number,
        },
        index: {
            type : Number,
        },
        id: {
            type : Number,
        },
        price: {
            type: Number,
        },
        menuId: {
            type : Number,
        },
    },
    mounted() {

    },
    methods: {
        ...mapActions(["addItemToBasket", "loadBasket","deleteBasketItem"]),
        deleteBasket(){
            this.deleteBasketItem(this.id)
        },
        addBasket(menuId) {
            this.addItemToBasket({
                id: menuId,
                quantity: +this.count
            })
        },
        setCount() {
            setTimeout(() => {
                this.count = this.quantity
            }, 900);
        }
    },
    created() {
        this.count = this.quantity
    }


}
</script>

<style scoped>

</style>
