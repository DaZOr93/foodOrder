<template>
    <div class="row gutters">
        <div class="col-xl-9 col-lg-9 col-md-12 col-sm-12 col-12">
            <div class="card h-100">
                <div class="card-body">
                    <form action="">
                        <div class="row gutters">
                            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                                <h6 class="mb-2 text-primary">Профиль</h6>
                            </div>
                            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                                <div class="form-group">
                                    <label for="name">Имя</label>
                                    <input type="text" class="form-control" name="name" placeholder="Введите имя"
                                           v-model="profile.name">
                                </div>
                            </div>
                            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                                <div class="form-group">
                                    <label for="email">Email</label>
                                    <input type="email" class="form-control" name="email" v-model="profile.email">
                                </div>
                            </div>
                            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                                <div class="form-group">
                                    <label for="phone">Телефон</label>
                                    <input type="text" class="form-control" placeholder="+3801237290997" name="phone"
                                           v-model="profile.phone">
                                </div>

                            </div>
                            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                                <div class="form-group">
                                    <label for="password">Пароль</label>
                                    <input v-model="profile.password" type="password" class="form-control" name="password">
                                </div>
                            </div>
                            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                                <div class="form-group">
                                    <label for="password_confirmation">Пароль еще раз</label>
                                    <input v-model="profile.password_confirmation" type="password" class="form-control" name="password_confirmation">
                                </div>
                            </div>
                        </div>
                    </form>
                        <div class="row gutters mt-4">
                            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                                <div class="text-right">
                                    <button v-on:click="update" class="btn btn-primary">Обновить</button>
                                </div>
                            </div>
                        </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import {mapGetters,  mapActions} from 'vuex';
export default {
    name: "profile",
    data() {
        return {
            profile: [],
        }
    },
    methods: {
        ...mapActions(['loadProfile','updateProfile']),
        update(){
            this.updateProfile(this.profile)
        }

    },
    mounted() {
        this.loadProfile()
            .then(res => {
                this.profile = this.stateProfile
                this.profile.password = ''
            })
    },
    computed: {
        ...mapGetters(['stateProfile'])

    }
}
</script>

<style scoped>

</style>
