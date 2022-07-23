<template>
    <div class="jumbotron">
        <h3 class="display-4">Редактирование блюда</h3>
        <p class="lead">Можно изменить картинку блюда</p>
           <menu-editor
           :stateMenuItem = stateMenuItem
           rightBtn="Обновить"
           @rightBtnAction = updateItem
           ></menu-editor>
    </div>
</template>

<script>
import {mapActions, mapGetters} from "vuex";
import menuEditor from "../../components/MenuEditor";


export default {
    name: "menuItemEdit",
    components: {menuEditor},

    props: {
        id: {
            type : Number,
        },
    },
    mounted() {
        this.loadMenuItem(this.id)
    },
    methods:{
        ...mapActions(["loadMenuItem","updateMenuItem"]),

        updateItem(data){
            this.updateMenuItem(data)
        }
    },
    computed: {
        ...mapGetters(['stateMenuItem'])
    }
}
</script>

<style scoped>

</style>
