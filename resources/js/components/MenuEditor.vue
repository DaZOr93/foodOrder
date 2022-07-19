<template>
    <div>
        <div class="row">
            <div class="col-sm-12 col-md-6">
                <div class="form-group mb-4">
                    <label for="name">Название блюда</label>
                    <input class="form-control" name="name" type="text" v-model="stateMenuItem.name"
                           id="name">
                </div>
                <div class="form-group mb-4">
                    <label for="category_id">Категория</label>
                    <select class="form-control" id="category_id" v-model="stateMenuItem.category_id"
                            name="category_id">
                        <option
                            v-for="(category, index) of stateCategories"
                            :key="index"
                            :value="category.id"
                        >
                            {{ category.name }}
                        </option>
                    </select>
                </div>
                <div class="form-group mb-4">
                    <label for="description">Описание</label>
                    <input class="form-control" name="description" type="text" v-model="stateMenuItem.description"
                           id="description">
                </div>
                <div class="form-group mb-4">
                    <label for="price">Цена</label>
                    <input class="form-control" name="price" type="text" v-model="stateMenuItem.price" id="price">
                </div>
                <img v-if="stateMenuItem.picture" class="rounded-circle" :src="`../../../${stateMenuItem.picture}`"
                     alt="Generic placeholder image" width="140" height="140">
                <div class="form-group mb-4">
                    <label for="image">Изображение блюда</label>
                    <input @change="addFile" name="image" type="file" id="image">
                </div>
            </div>
        </div>
        <div class="form-group">
            <button class="btn btn-success" @click="$router.go(-1)" role="button">Назад</button>
            <button class="btn btn-success" v-on:click="actionForm">{{ rightBtn }}</button>
        </div>
    </div>

</template>

<script>
import {mapActions, mapGetters} from "vuex";

export default {
    name: "MenuEditor",
    data() {
        return {
            formDataItem: new FormData(),
        }
    },
    mounted() {
        this.loadCategories()
    },
    props: {
        stateMenuItem: {
            type: Object,
            default() {
                return {
                    name: '',
                    description: '',
                    price: null,

                }
            }
        },
        rightBtn: {
            type: String
        }
    },
    methods: {
        ...mapActions(["loadCategories"]),
        addFile(event) {
            let file = event.target.files[0]
            this.formDataItem.append('image', file)
        },
        actionForm() {
            this.formDataItem.append('name', this.stateMenuItem.name)
            this.formDataItem.append('category_id', this.stateMenuItem.category_id)
            this.formDataItem.append('description', this.stateMenuItem.description)
            this.formDataItem.append('price', this.stateMenuItem.price)
            this.formDataItem.append('id', this.stateMenuItem.id)
            this.$emit('rightBtnAction', this.formDataItem)
        }
    },
    computed: {
        ...mapGetters(['stateCategories'])
    }
}
</script>

<style scoped>

</style>
