import axios from "./Api.js";
import {authStore} from "../store/authStore.js";
import router from "../router/index.js";

export const attemptToGetLoggedInUser = async() => {

    axios.get('user').then(response => {
        if (200 === response.status || 204 === response.status) {
            console.log(response.data)

            // login the user
            authStore.login(response.data);

            // redirect to homepage
            router.push({name: 'Home'});
        }
    }).catch(err => {
        authStore.reset();
        window.location = 'http://localhost:8000/login';

    });
}


