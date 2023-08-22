import {reactive} from "vue";

// Set state object with values that are changed programmatically
export const authStore = reactive({
    loggedIn: false,
    user: {},
    message: '',

    getUser() {
        return this.user;
    },


    // logs in the user
    login(user) {
        this.loggedIn = true;
        this.user = user;
    },

    register() {
        this.message = 'Successful registration.';
    },

    reset() {
        this.loggedIn = false;
        this.user = null;
    },

    // logs out the user
    logout() {
        this.loggedIn = false;
        this.user = null;
        this.message = 'Successful logout.';

    },

    // checks if user is authenticated
    isAuthenticated() {
        return this.user !== null;
    }


});

