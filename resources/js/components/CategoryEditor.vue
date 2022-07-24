<template>
    <div>
        <ValidationObserver v-slot="{ handleSubmit }">
            <form @submit.prevent="handleSubmit(actionForm)">
        <div class="row">
            <div class="col-sm-12 col-md-6">

                <div class="form-group mb-4">
                    <label for="name">Название категории</label>
                    <ValidationProvider rules="required|min_value:3" v-slot="{ errors }">
                    <input class="form-control" name="name" type="text" v-model="stateCategoryItem.name" id="name">
                        <span>{{ errors[0] }}</span>
                    </ValidationProvider>
                </div>

                <img v-if="stateCategoryItem.picture" class="rounded-circle" :src="`../../../${stateCategoryItem.picture}`"
                     alt="Generic placeholder image" width="140" height="140">
                <div class="form-group mb-4">
                    <label for="image">Изображение категории</label>
                    <ValidationProvider rules="required|image" v-slot="{ errors }">
                    <input @change="addFile" name="image" type="file" id="image">
                    <span>{{ errors[0] }}</span>
                </ValidationProvider>
                </div>
            </div>
        </div>
        <div class="form-group">
            <button class="btn btn-success" @click="$router.go(-1)" role="button">Назад</button>
            <button class="btn btn-success" type="submit">{{ rightBtn }}</button>
        </div>
            </form>
        </ValidationObserver>
    </div>

</template>

<script>
import {ValidationProvider, ValidationObserver} from 'vee-validate/dist/vee-validate.full.esm';

export default {
    components: {
        ValidationProvider,
        ValidationObserver
    },
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
