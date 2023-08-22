import {createApp} from 'vue';
import {attemptToGetLoggedInUser} from './api/useAuth.js';
import App from './App.vue';
import router from "./router";
import {FontAwesomeIcon} from '@fortawesome/vue-fontawesome'; /* import font awesome icon component */
import library from "./icons/icons"

const app = createApp(App)
    .component('font-awesome-icon', FontAwesomeIcon)
    .use(router);

// get user data if logged in
attemptToGetLoggedInUser().then(val => {
    app.mount('#app');
})

// bind the Vue app to the root DOM element

