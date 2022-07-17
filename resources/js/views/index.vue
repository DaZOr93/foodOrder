<template>
    <div>

        <div class="row">

            <div v-on:click='selectCategory(category.id)' class="col-lg-2 text-center category"
                 v-for="category in categories">
                <img class="category rounded-circle" :src="category.picture" alt="Generic placeholder image" width="140"
                     height="140">
                <h6>{{ category.name }}</h6>
            </div>

        </div>
        <div class="px-3 py-2 border-bottom border-top mb-3">
            <div class="container d-flex flex-wrap justify-content-center">
                <h4>Меню</h4>
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
        categories: [],
        search: "",
        messages: [],
    }),
    mounted() {
        this.loadMenu();
        this.loadCategory()

    },
    computed: {
        filteredMenu() {
            return this.menu.filter(
                element => element.name.toLowerCase().includes(this.search.toLowerCase())
            )
        },
    },
    methods: {
        ...mapActions(['addNotification']),
        loadMenu() {
            axios.get('/api/menu')
                .then(res => {
                    this.menu = res.data;
                })
        },
        loadCategory() {
            axios.get('/api/category')
                .then(res => {
                    this.categories = res.data;
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
