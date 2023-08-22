<template>

    <div class="login">
        <h3>Login</h3>

        <Alert v-if="isShowAlert() === true" :color="alertColor" :heading="''">
            {{ setAlert() }}
        </Alert>

        <form @submit.prevent="initLogin">

            <div>
                <label for="email">Email</label>
                <input id="email"
                       type="email"
                       name="email"
                       v-model="email"
                       :class="{ 'border border-red' : errors.email}">
                <div v-show="errors.email" :class="['error-message']">
                    {{ errors.email && errors.email[0] }}
                </div>
            </div>

            <div>
                <label for="password">Password</label>
                <input id="password"
                       type="password"
                       name="password"
                       v-model="password"
                       :class="{ 'border border-red' : errors.email}"
                       autocomplete="current-password">
                <div v-show="errors.password" :class="['error-message']">
                    {{ errors.password && errors.password[0] }}
                </div>
            </div>


            <div class="inline-block margin-top-1 margin-bottom-1">
                <input type="checkbox" name="remember" v-model="remember" id="remember"
                       class="margin-left-0">
                <label for="remember" style="display: inline">
                    Remember Me
                </label>
            </div>

            <div class="bar">
                <button id="login-button" type="submit" class="primary submit">Login</button>

                <a class="button primary alt margin-top-1" href="">Forgot Your Password?</a>
            </div>
        </form>
    </div>

</template>

<script>
import User from "../../api/User.js";
import {authStore} from "../../store/authStore";
import Guest from "../../layout/Guest.vue";
import Alert from "../../components/clean/Alert.vue";

export default {
    name: "Login",
    mixins: [User],
    components: {
        Alert
    },
    data() {
        return {
            authStore,
            name: '',
            email: '',
            password: '',
            remember: false,
            alertMessage: '',
            alertColor: 'danger',
            alertHeading: '',
            errors: {},

        }
    },

    created() {
        this.$emit('update:layout', Guest);
    },


    mounted() {
        this.email = import.meta.env.VITE_USERNAME;
        this.password = import.meta.env.VITE_PASSWORD;
        this.alertColor = '';
        this.alertHeading = '';
        this.errors = {};
    },
    methods: {
        initLogin() {
            const credentials = {
                email: this.email,
                password: this.password,
                remember: this.remember
            };

            this.login(credentials);
        },

        isShowAlert() {
            return this.alertMessage !== '' || authStore.message !== '';
        },

        setAlert() {
            if (this.alertMessage !== '') {
                this.alertColor = 'danger';
                return this.alertMessage;

            } else if (authStore.message !== '') {
                this.alertColor = 'info';
                return authStore.message;

            } else {
                return '';
            }
        }
    }
}
</script>

<style scoped>

</style>
