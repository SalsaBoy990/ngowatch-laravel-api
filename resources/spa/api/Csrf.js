import axios from "axios";
import Cookie from "js-cookie";
import {BASE_URL} from "../constants/constants";

export default {
    getCookie() {
        let token = Cookie.get("XSRF-TOKEN");

        if (token) {
            return new Promise(resolve => {
                resolve(token);
            });
        }

        return axios.get(BASE_URL + 'sanctum/csrf-cookie');
    }
};
