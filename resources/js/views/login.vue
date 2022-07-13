<template>
    <div class="mt-5 justify-content-center d-flex">
        <div class=" text-center ">
            <router-link to="/" class=" mb4 align-items-center my-2 my-lg-0 me-lg-auto text-black text-decoration-none">
                <svg class="bi me-2" width="40" height="32" role="img" aria-label="Food">
                    <use xlink:href="#food"></use>
                </svg>
            </router-link>
            <h1 class="h3 mb-3 font-weight-normal">Пожалуйста введите данные</h1>
            <label for="inputEmail" class="sr-only">Email</label>
            <input v-model="email" type="email" id="inputEmail" class="form-control" placeholder="Email address" required="" autofocus="">
            <label  for="inputPassword" class="sr-only">Пароль</label>
            <input v-model="password" type="password" id="inputPassword" class=" mb-2 form-control" placeholder="Пароль" required="">

            <div>
                <button v-on:click="login()" class="btn btn-lg  btn-primary btn-block" type="button">Войти</button>
                <router-link to="/registration"  class="btn btn-lg  btn-primary btn-block" type="button">Регистрация</router-link>
            </div>
        </div>
    </div>
</template>

<script>
import {mapGetters, mapMutations, mapActions} from 'vuex';
import {axiosInstance} from "../service/api";
export default {
    name: "login",
    data() {
        return{
            email: 'dazorchik@gmail.com',
            password: '124500abc',
        }
    },
    methods: {
        ...mapActions(["addNotification", "addNotificationError"]),
        login() {
            return axiosInstance.get('/sanctum/csrf-cookie').then((resp) => {
                axiosInstance.post('/login', {email: this.email, password: this.password})
                    .then((resp) =>{
                        this.addNotification('Вы авторизоваись')
                        this.$router.push({name: 'index'})
                    })
                    .catch(err=>{
                        this.addNotificationError('Неверные данные')
                    })
            })
        },
    }
}
</script>

<style scoped>

</style>
