<template>
    <div class="mt-5 justify-content-center d-flex">
        <div class=" text-center ">
            <router-link to="/" class=" mb4 align-items-center my-2 my-lg-0 me-lg-auto text-black text-decoration-none">
                <svg class="bi me-2" width="40" height="32" role="img" aria-label="Food">
                    <use xlink:href="#food"></use>
                </svg>
            </router-link>
            <h1 class="h3 mb-3 font-weight-normal">Введите данные для регистрации</h1>
            <input v-model="name" type="text" id="inputName" class="form-control mb-1" placeholder="Введите имя" required="" autofocus="">
            <input v-model="email" type="email" id="inputEmail" class="form-control mb-1" placeholder="Email address" required="" autofocus="">
            <input v-model="phone" type="tel" id="inputPhone" class="form-control mb-1" placeholder="+380507290987" required="" autofocus="">
            <input v-model="password" type="password" id="inputPassword" class=" mb-1 form-control" placeholder="Пароль" required="">
            <input v-model="password_confirmation" type="password" id="password_confirmation" class=" mb-2 form-control" placeholder="Пароль еще раз" required="">
            <div>
                <router-link to="/login" class="btn btn-lg  btn-primary btn-block" type="button">Войти</router-link>
                <button v-on:click="registration()" class="btn btn-lg  btn-primary btn-block" type="button">Регистрация</button>
            </div>

        </div>
    </div>
</template>

<script>
import {mapGetters, mapMutations, mapActions} from 'vuex';
import {axiosInstance} from "../service/api";
export default {
    name: "registration",
    data() {
        return{
            email: 'dazorchik@gmail.com',
            password: '124500abc',
            password_confirmation: '124500abc',
            phone: 380507290987,
            name: '',
        }
    },
    methods: {
        ...mapActions(["addNotification", "addNotificationError","readToken"]),
        registration() {
            return axiosInstance.get('/sanctum/csrf-cookie').then((resp) => {
                axiosInstance.post('/register', {
                    email: this.email,
                    name: this.name,
                    phone: this.phone,
                    password: this.password,
                    password_confirmation: this.password_confirmation
                })
                    .then((resp) =>{
                        this.addNotification('Вы зарегистрировались')
                        localStorage.setItem('x_xsrf_token', resp.config.headers['X-XSRF-TOKEN'])
                        this.readToken()
                        this.$router.push({name: 'index'})
                    })
                    .catch(err=>{
                        let errors = err.response.data.errors
                        for(let key in errors){
                            this.addNotificationError(errors[key][0])

                        }
                    })
            })
        },
    }
}
</script>

<style scoped>

</style>
