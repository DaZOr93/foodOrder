<template>
    <div>
        <div class="px-3 py-2 border-bottom mb-3">
            <div class="container d-flex flex-wrap justify-content-center">
                <h4>Категории</h4>
                <router-link to="/dashboard/categories" v-if="stateUser['role_id'] === 1" class="category_edit" >Ред.</router-link>
            </div>
        </div>
        <div class="row">

            <div v-on:click='selectCategory(category.id)' class="col-lg-2 text-center category"
                 v-for="category in stateCategories">
                <img class="category rounded-circle" :src="category.picture" alt="Generic placeholder image" width="140"
                     height="140">
                <h6>{{ category.name }}</h6>
            </div>

        </div>
        <div class="px-3 py-2 border-bottom border-top mb-3">
            <div class="container d-flex flex-wrap justify-content-center">
                <h4>Меню</h4>
                <router-link to="/dashboard/menu/add" v-if="stateUser['role_id'] === 1" class="category_edit" >Доб.</router-link>

            </div>

            <div class="container d-flex justify-content-center align-items-center">
                <div class="col-3" >
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <div class="input-group-text">Поиск</div>
                        </div>
                        <input v-model="search" type="text" class="form-control" id="inlineFormInputGroup" placeholder="Название блюда">
                    </div>
                </div>
                <div class="col-5 d-flex flex-wrap justify-content-center align-items-center">
                    <div class="m-lg-1">Сортировка:</div>
                    <sort-component  @sort="sortHandler" ></sort-component>
                </div>
            </div>
        </div>


        <div class="row">
            <menu-item-component v-for="menu_item in  filteredMenu"
                                 :picture="menu_item.picture"
                                 :name="menu_item.name"
                                 :category="menu_item.category.name"
                                 :id="menu_item.id"
                                 :price="menu_item.price"
                                 :key="menu_item.id"
                                 @deleteItem = deleteItem
            ></menu-item-component>
        </div>
    </div>
</template>

<script>
import axios from 'axios';
import MenuItemComponent from "../components/MenuItemComponent";
import SortComponent from '../components/SortComponent';
import {mapGetters, mapMutations, mapActions} from 'vuex';

export default {
    name: "index",
    components: {SortComponent, MenuItemComponent},

    data: () => ({
        loading: true,
        menu: [],
        search: "",
        messages: [],
    }),
    mounted() {
        this.loadMenu();
        this.loadCategories()

    },
    computed: {
        ...mapGetters(['stateCategories','stateUser']),
        filteredMenu() {
            return this.menu.filter(
                element => element.name.toLowerCase().includes(this.search.toLowerCase())
            )
        },
    },
    methods: {
        ...mapActions(['addNotification','loadCategories',"deleteMenuItem"]),
        deleteItem(id){
            this.deleteMenuItem(id)
                .then((resp) => {
                    if(resp.status === 200) {
                        this.loadMenu()
                    }
                })
        },
        loadMenu() {
            axios.get('/api/menu')
                .then(res => {
                    this.menu = res.data;
                })
        },
        selectCategory(id) {
            axios.get('/api/menu/category/' + id)
                .then(res => {
                    this.menu = res.data;
                    this.addNotification('Категория выбанна');

                })
        },

        sortHandler(option) {
            let field = option.field
            let direction = option.direction
            function byField(field, direction) {
                if(direction === 'DESC'){
                    return (a, b) => a[field] < b[field] ? 1 : -1;
                }
                return (a, b) => a[field] > b[field] ? 1 : -1;
            }
            this.menu = this.menu.sort(byField(field, direction))
        }
    },

}
</script>

<style scoped>

</style>
