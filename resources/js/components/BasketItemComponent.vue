<template>

        <tr>
            <th scope="row"> {{index+1}} </th>
            <td> {{name}} </td>
            <td> {{price}} </td>
            <td class="d-flex" >
                <input type="number" name="quantity" max="20" min="1"  v-model="count" class="form-control quantity" >
                <button type="button" v-on:click="addBasket(menuId)" class="btn btn-sm btn-outline-secondary">Ок</button>
            </td>
            <td> {{price*quantity}} </td>
            <td>
                <button class="btn btn-danger btn-sm" onclick="return confirm('Удалить позицию?')" type="submit">Удалить</button>
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
        ...mapActions(["addItemToBasket", "loadBasket", "addNotification"]),
        async addBasket(menuId) {

           await this.addItemToBasket({
                id: menuId,
                quantity: +this.count
            })
            this.addNotification('Обновлено')
            this.loadBasket()
        },

    },
    created() {
        this.count = this.quantity
    }


}
</script>

<style scoped>

</style>
