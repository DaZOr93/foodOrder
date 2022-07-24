<template>
    <div class="jumbotron">
        <h3 class="display-4">Добавление блюда</h3>
        <p class="lead">Не забудьте добавить картику</p>
        <menu-editor
            rightBtn="Добавить"
            @rightBtnAction = addItem
        ></menu-editor>
    </div>
</template>

<script>
import {mapActions, mapGetters} from "vuex";
import menuEditor from "../../components/MenuEditor";


export default {
    name: "menuItemEdit",
    components: {menuEditor},
    methods:{
        ...mapActions(["addMenuItem"]),

        addItem(data){
            this.addMenuItem(data)
                .then((resp) => {
                    if(resp.status === 200) {
                        this.$router.push('/')
                    }
            })

        }
    },
    computed: {

    }
}
</script>

<style scoped>

</style>
