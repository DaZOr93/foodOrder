<template>
    <div>
        <div class="row">
            <div class="col-sm-12 col-md-6">
                <div class="form-group mb-4">
                    <label for="name">Название категории</label>
                    <input class="form-control" name="name" type="text" v-model="stateCategoryItem.name" id="name">
                </div>
                <img v-if="stateCategoryItem.picture" class="rounded-circle" :src="`../../../${stateCategoryItem.picture}`"
                     alt="Generic placeholder image" width="140" height="140">
                <div class="form-group mb-4">
                    <label for="image">Изображение категории</label>
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

export default {
    name: "CategoryEditor",
    data() {
        return {
            formDataItem: new FormData(),
        }
    },
    mounted() {
    },
    props: {
        stateCategoryItem: {
            type: Object,
            default() {
                return {
                    name: '',
                }
            }
        },
        rightBtn: {
            type: String
        }
    },
    methods: {
        addFile(event) {
            let file = event.target.files[0]
            this.formDataItem.append('image', file)
        },
        actionForm() {
            this.formDataItem.append('name', this.stateCategoryItem.name)
            this.formDataItem.append('id', this.stateCategoryItem.id)
            this.$emit('rightBtnAction', this.formDataItem)
        }
    },
    computed: {
    }
}
</script>

<style scoped>

</style>
