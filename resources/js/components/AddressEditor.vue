<template>
    <div class="row gutters mb-3">
        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
            <div class="form-group">
                <label for="city">Город</label>
                <input v-on:change="handlerAddress" type="text" class="form-control"  name="city" placeholder="Введите город"
                       v-model="newCity">
            </div>
        </div>
        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
            <div class="form-group">
                <label for="street">Улица</label>
                <input v-on:change="handlerAddress"  type="text" class="form-control" name="street" placeholder="Введите улицу"
                       v-model="newStreet">
            </div>
        </div>
        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
            <div class="form-group">
                <label for="house">Дом</label>
                <input v-on:change="handlerAddress" type="text" class="form-control" name="house" placeholder="Введите номер дома"
                       v-model="newHouse">
            </div>
        </div>
        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
            <div class="form-group">
                <label for="apartment">Квартира</label>
                <input v-on:change="handlerAddress" type="text" class="form-control" name="apartment" placeholder="Введите номер квартиры"
                       v-model="newApartment">
            </div>
        </div>
    </div>
</template>

<script>
export default {
    name: "AddressEditor",
    data(){
        return {
            newCity: this.city,
            newStreet: this.street,
            newHouse: this.house,
            newApartment: this.apartment
        }
    },
    props: {
        id: {
            type: Number,
            default: null
        },
        city: {
            type: String,
            default: "",
        },
        street: {
            type: String,
            default: "",
        },
        house: {
            type : String,
            default: "",
        },
        apartment: {
            type: String,
            default: "",
        },
    },
    methods: {
        handlerAddress () {
            this.$emit('handlerAddress', {
                city: this.newCity,
                street: this.newStreet,
                house: this.newHouse,
                apartment: this.newApartment
            })
        }

    }
}
</script>

<style scoped>

</style>
