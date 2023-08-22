import axios from "axios";
import {BASE_URL} from "../constants/constants.js";

const Auth = axios.create({
    baseUrl: BASE_URL + 'api/',
    headers: {
        "Accept": "application/json",
        "Content-Type": "application/json"
    }
})

Auth.defaults.withCredentials = true;

export default Auth;
