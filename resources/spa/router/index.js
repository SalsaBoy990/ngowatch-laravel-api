import {createRouter, createWebHashHistory, createWebHistory} from "vue-router";

import Home from "../pages/private/Home.vue";
import Hello from "../pages/private/Hello.vue";
import Login from "../pages/public/Login.vue";
import Dashboard from "../pages/private/Dashboard.vue";

import {authStore} from "../store/authStore";
import Register from "../pages/public/Register.vue";

const routes = [
    {
        path: "/",
        name: "Home",
        component: Home,
    },
    /*    {
            path: "/login",
            name: "Login",
            component: Login,
        },*/
    /*    {
            path: "/register",
            name: "Register",
            component: Register,
        },*/
    {
        path: "/hello",
        name: "Hello",
        // route level code-splitting
        // this generates a separate chunk (about.[hash].js) for this route
        // which is lazy-loaded when the route is visited.
        component: Hello,
    },

    {
        path: "/dashboard",
        name: "Dashboard",
        component: Dashboard,
    },
];
const router = createRouter({
    history: createWebHashHistory(),
    routes,
});

// Auth guard redirects
router.beforeEach(async (to, from) => {
    // make sure the user is authenticated
    if (!authStore.isAuthenticated()) {
        authStore.message = 'You need to login to access this page.'
        // redirect the user to the login page
        window.location = 'http://localhost:8000/login';
        // return {name: 'Login'}
    }
})

export default router;
