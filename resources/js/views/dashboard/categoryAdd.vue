<template>
    <div class="jumbotron">
        <h3 class="display-4">Добавление категории</h3>
        <p class="lead">Не забудьте добавить картику</p>
        <category-editor
            rightBtn="Добавить"
            @rightBtnAction=addItem
        ></category-editor>
    </div>
</template>

<script>
import {mapActions} from "vuex";

import CategoryEditor from "../../components/CategoryEditor";


export default {
    name: "categoryEdit",
    components: {CategoryEditor},
    methods: {
        ...mapActions(["addCategoryItem"]),

        addItem(data) {
            this.addCategoryItem(data)
                .then((resp) => {
                    if (resp.status === 200) {
                        this.$router.push('/dashboard/categories')
                    }
                })
        }
    },
}
</script>

<style scoped>

</style>
