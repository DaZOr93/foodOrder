<template>
    <div class="container">
        <div class="jumbotron">
            <h2 class="display-4">Список категорий</h2>
            <p class="lead">Здесь вы можете добавлять, редактировать и удалять категории.</p>
            <a class="btn btn-primary btn-lg"  role="button">Добавить категорию</a>
        </div>

        <table class="table table-striped">
            <thead>
            <tr>
                <th scope="col">id</th>
                <th scope="col">Название категории</th>
                <th scope="col">Картинка</th>
                <th colspan="2" scope="col">Действия</th>
            </tr>
            </thead>
            <tbody>

            <tr v-for="(category, index) in stateCategories">
                <th scope="row"> {{category.id}} </th>
                <td> {{category.name}} </td>
                <td> <img class="rounded-circle category" :src="`../${category.picture}`" alt="Generic placeholder image" width="140" height="140"></td>
                <td>
                    <a class="btn btn-primary mt-3 mb-3 btn-sm" >Редактировать</a>
                        <button class="btn btn-danger btn-sm" onclick="return confirm('Удалить категорию?')" type="submit">Удалить</button>
                </td>
            </tr>
            </tbody>
        </table>
    </div>
</template>

<script>
import {mapActions, mapGetters} from "vuex";
export default {
    name: "categories",
    mounted(){
      this.loadCategories()
    },
    methods: {
        ...mapActions(['loadCategories'])
    },
    computed: {
        ...mapGetters(['stateCategories'])
    }
}
</script>

<style scoped>

</style>
