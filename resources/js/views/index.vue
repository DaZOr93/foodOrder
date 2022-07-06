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
                <div class="col-3">
                    <div class="input-group mb-2">
                        <div class="input-group-prepend">
                            <div class="input-group-text">Поиск</div>
                        </div>
                        <input v-model="search" type="text" class="form-control" id="inlineFormInputGroup" placeholder="Название блюда">
                    </div>
                </div>
                <div class="col-5 d-flex flex-wrap justify-content-center align-items-center">
                    <div class="m-lg-1">Сортировка:</div>
                    <select @change="sortByField($event)" class="btn btn-sm btn-outline-secondary dropdown-toggle">
                        <option selected disabled>Не выбранна</option>
                        <option value="name" >Название по возрастанию</option>
                        <option value="name" method="desc">Название по убыванию</option>
                        <option value="price">Цена по возрастанию</option>
                        <option value="price" method="desc">Цена по убыванию</option>
                    </select>
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

export default {
    name: "index",
    components: {MenuItemComponent},

    data: () => ({
        loading: true,
        menu: [],
        categories: [],
        search: "",


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
                })
        },
        sortByField(event) {
            let field = event.target.value
            let method = event.target.method
            console.log(event.target.method)
            function byField(field, method) {
                if(method === 'desc'){
                    return (a, b) => a[field] < b[field] ? 1 : -1;
                }
                return (a, b) => a[field] > b[field] ? 1 : -1;
            }
            this.menu = this.menu.sort(byField(field, method))
        }
    },

}
</script>

<style scoped>

</style>
