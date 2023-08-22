<template>

    <div class="register">
        <h3>Register</h3>

        <Alert v-if="isShowAlert() === true" :color="alertColor" :heading="''">
            {{ setAlert() }}
        </Alert>

        <form @submit.prevent="initRegistration">

            <div>
                <label for="name">Name</label>
                <input id="name"
                       type="text"
                       name="name"
                       v-model="name"
                       :class="{ 'border border-red' : errors.name}">
                <div v-show="errors.name" :class="['error-message']">
                    {{ errors.name && errors.name[0] }}
                </div>
            </div>

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
                       :class="{ 'border border-red' : errors.password}"
                       autocomplete="new-password"
                >
                <div v-show="errors.password" :class="['error-message']">
                    {{ errors.password && errors.password[0] }}
                </div>
            </div>

            <div>
                <label for="password_confirmation">Confirm Password</label>
                <input id="password_confirmation"
                       type="password"
                       name="password_confirmation"
                       v-model="passwordConfirmation"
                       :class="{ 'border border-red' : errors.password}"
                       autocomplete="new-password"
                >
                <div v-show="errors.password" :class="['error-message']">
                    {{ errors.password && errors.password[0] }}
                </div>
            </div>

            <button id="register-button" type="submit" class="primary submit">Register</button>
        </form>
    </div>

</template>

<script>
import User from "../../api/User.js";
import {authStore} from "../../store/authStore";
import Guest from "../../layout/Guest.vue";
import Alert from "../../components/clean/Alert.vue";

export default {
    name: "Register",
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
            passwordConfirmation: '',
            alertMessage: '',
            alertColor: '',
            errors: {},

        }
    },

    created() {
        this.$emit('update:layout', Guest);
    },


    mounted() {
        this.name = 'Tiesto';
        this.email = 'teszt@elek.hu';
        this.password = 'password';
        this.passwordConfirmation = 'password';
        this.alertColor = '';
        this.alertMessage = '';
        this.errors = {};
    },
    methods: {
        initRegistration() {
            const formData = {
                name: this.name,
                email: this.email,
                password: this.password,
                password_confirmation: this.passwordConfirmation
            };

            this.register(formData);
        },

        isShowAlert() {
            return this.alertMessage !== '' || authStore.message !== '';
        },

        setAlert() {
            if (this.alertMessage !== '') {
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
