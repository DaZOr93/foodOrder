<template>
    <div class="col-md-4">
        <div class="card mb-4 box-shadow">
        <img class="card-img-top" alt="Thumbnail [100%x225]" style="height: 225px; width: 100%; display: block;" :src="picture" data-holder-rendered="true">
        <div class="card-body">
            <p class="card-text"> {{ name }}</p>
            <p class="category_menu card-text">{{ category }} </p>
            <div class="d-flex justify-content-between align-items-center">
                <div v-if="stateUser['role_id'] === 1">
                    <router-link :to="{ name: 'menuItemEdit', params: { id: id } }" type="button" class="btn btn-sm btn-outline-secondary">Редактировать</router-link>
                    <button v-on:click="deleteItem" type="button" class="btn btn-sm btn-outline-secondary">Удалить</button>
                </div>
                <div v-else class="btn-group">
                    <input type="number"  v-model="count" name="quantity" max="20" min="1" class="form-control quantity" >
                    <button v-on:click="addBasket(id)" type="button" class="btn btn-sm btn-outline-secondary">Добавить в корзину</button>
                </div>
                <small class="text-muted">{{ price }} грн.</small>
            </div>
        </div>
    </div>
    </div>

</template>

<script>
import {mapActions, mapGetters} from 'vuex';
export default {
    name: "MenuItemComponent",
    props: {
        picture: {
            type: String,
        },
        name: {
            type: String,
        },
        category: {
            type : String,
        },
        id: {
            type : Number,
        },
        price: {
            type: Number,
        }
    },
    data: () => ({
        count: 1,
    }),
    methods: {
        ...mapActions(["addItemToBasket",]),
        addBasket(id) {

           this.addItemToBasket({
               id: id,
               quantity: +this.count
           })
        },
        deleteItem(){
            this.$emit('deleteItem', this.id)
        }

    },
    computed: {
        ...mapGetters(['stateUser']),

    }

}
</script>


<style scoped>

</style>
