<template>
    <div class="jumbotron">
        <h3 class="display-4">Редактирование блюда</h3>
        <p class="lead">Можно изменить картинку блюда</p>
        <category-editor
            :stateCategoryItem = stateCategoryItem
            rightBtn="Обновить"
            @rightBtnAction = updateItem
        ></category-editor>
    </div>
</template>

<script>
import {mapActions, mapGetters} from "vuex";
import categoryEditor from "../../components/CategoryEditor";


export default {
    name: "categoryEdit",
    components: {categoryEditor},

    props: {
        id: {
            type : Number,
        },
    },
    mounted() {
        this.loadCategoryItem(this.id)
    },
    methods:{
        ...mapActions(["loadCategoryItem","updateCategoryItem"]),

        updateItem(data){
            this.updateCategoryItem(data)
        }
    },
    computed: {
        ...mapGetters(['stateCategoryItem'])
    }
}
</script>

<style scoped>

</style>
