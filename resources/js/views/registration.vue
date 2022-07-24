<template>
    <div class="mt-5 justify-content-center d-flex">
        <div class=" text-center ">
            <router-link to="/" class=" mb4 align-items-center my-2 my-lg-0 me-lg-auto text-black text-decoration-none">
                <svg class="bi me-2" width="40" height="32" role="img" aria-label="Food">
                    <use xlink:href="#food"></use>
                </svg>
            </router-link>
            <ValidationObserver v-slot="{ handleSubmit }">
                <form @submit.prevent="handleSubmit(registration)">
                    <h1 class="h3 mb-3 font-weight-normal">Введите данные для регистрации</h1>
                    <ValidationProvider rules="required|min_value:3" v-slot="{ errors }">
                        <div>
                            <input v-model="name" type="text" id="inputName" class="form-control mb-1"
                                   placeholder="Введите имя"
                                   required="" autofocus="">
                        </div>
                        <span>{{ errors[0] }}</span>
                    </ValidationProvider>
                    <ValidationProvider rules="required|email" v-slot="{ errors }">
                        <div>
                            <input v-model="email" type="email" id="inputEmail" class="form-control mb-1"
                                   placeholder="Email address" required="" autofocus="" autocomplete="on">
                        </div>
                        <span>{{ errors[0] }}</span>
                    </ValidationProvider>
                    <ValidationProvider :rules="{ regex: /^\+380\d{3}\d{2}\d{2}\d{2}$/ }" v-slot="{ errors }">
                        <div>
                            <input v-model="phone" type="tel" id="inputPhone" class="form-control mb-1"
                                   placeholder="+380507290987"
                                   required="" autofocus="">
                        </div>
                        <span>{{ errors[0] }}</span>
                    </ValidationProvider>
                    <ValidationProvider rules="required|min_value:8" v-slot="{ errors }">
                        <div>
                            <input v-model="password" type="password" id="inputPassword" class=" mb-1 form-control"
                                   placeholder="Пароль" required="" autocomplete="on">
                        </div>
                        <span>{{ errors[0] }}</span>
                    </ValidationProvider>
                    <ValidationProvider rules="required|min_value:8" v-slot="{ errors }">
                        <div>
                            <input v-model="password_confirmation" type="password" id="password_confirmation"
                                   class=" mb-2 form-control" placeholder="Пароль еще раз" required=""
                                   autocomplete="off">
                        </div>
                        <span>{{ errors[0] }}</span>
                    </ValidationProvider>
                    <div>
                        <router-link to="/login" class="btn btn-lg  btn-primary btn-block" type="button">Войти
                        </router-link>
                        <button class="btn btn-lg  btn-primary btn-block" type="submit">
                            Регистрация
                        </button>
                    </div>
                </form>
            </ValidationObserver>
        </div>
    </div>
</template>

<script>
import {mapActions} from 'vuex';
import {axiosInstance} from "../service/api";
import {ValidationProvider, ValidationObserver} from 'vee-validate/dist/vee-validate.full.esm';

export default {
    components: {
        ValidationProvider,
        ValidationObserver
    },
    name: "registration",
    data() {
        return {
            email: '',
            password: '',
            password_confirmation: '',
            phone: '',
            name: '',
        }
    },
    methods: {
        ...mapActions(["addNotification", "addNotificationError", "readToken", "readUser"]),
        registration() {
            return axiosInstance.get('/sanctum/csrf-cookie').then((resp) => {
                axiosInstance.post('/register', {
                    email: this.email,
                    name: this.name,
                    phone: this.phone,
                    password: this.password,
                    password_confirmation: this.password_confirmation
                })
                    .then((resp) => {
                        this.addNotification('Вы зарегистрировались')
                        localStorage.setItem('x_xsrf_token', resp.config.headers['X-XSRF-TOKEN'])
                        this.readToken()
                        this.readUser()
                        this.$router.push({name: 'index'})
                    })
                    .catch(err => {
                        let errors = err.response.data.errors
                        for (let key in errors) {
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
