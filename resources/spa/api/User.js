import axios from "./Api.js";
import Csrf from "./Csrf";
import {authStore} from "../store/authStore.js";
import router from "../router/index.js";

// mixin!
export default {
    data: () => ({}),
    methods: {

        successMessage(msg) {
            this.alertMessage = msg;
            this.alertColor = 'success';
        },

        errorMessage(msg) {
            this.alertMessage = msg;
            this.alertColor = 'danger';
        },

        infoMessage(msg) {
            this.alertMessage = msg;
            this.alertColor = 'info';
        },

        /**
         *
         * @param formData
         * @returns {Promise<void>}
         */
        async login(formData) {
            await Csrf.getCookie();

            axios.post("login", formData).then(response => {
                console.log(response)
                if (200 === response.status || 204 === response.status) {
                    console.log(response.data)

                    // log in the user
                    authStore.login();

                    // redirect to homepage
                    router.push({name: 'Home'});
                }
            }).catch(err => {
                this.errors = err.response.data.errors;
                this.errorMessage(err.message);
            });
        },


        async register(formData) {
            await Csrf.getCookie();

            axios.post('register', formData).then(response => {
                // created
                if (201 === response.status) {
                    console.log('registered');
                    this.successMessage('Successful registration');
                }
            }).then(() => new Promise(resolve => setTimeout(resolve, 2000)
            )).then(() => {
                    // redirect to login page
                    router.push({name: 'Login'});
                }
            )
                .catch(err => {
                    this.errors = err.response.data.errors;
                    this.errorMessage(err.message);
                });
        },


        async logout() {
            await Csrf.getCookie();

            return axios.post('logout').then(response => {
                if (204 === response.status) {
                    // logout
                    authStore.logout();

                    // redirect to external login page
                    window.location = 'http://localhost:8000/login';
                    // router.push({name: 'Login'});
                }
            }).catch(err => {
                this.errors = err.response.data.errors;
                this.errorMessage(err.message);
            });
        }
        ,


        async getUser() {
            await Csrf.getCookie();
            axios.get("api/user").then(response => {
                console.log(response)
                if (200 === response.status || 204 === response.status) {
                    console.log(response.data)

                    // log in the user
                    authStore.login();

                    // redirect to homepage
                    router.push({name: 'Home'});
                }
            }).catch(err => {
                // this.errors = err.response.data.errors;
                this.alertMessage = err.message;
            });
        }

    }
}
;
